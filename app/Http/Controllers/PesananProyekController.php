<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ListProyek;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

use function Laravel\Prompts\select;

class PesananProyekController extends Controller
{
    /**
     * list pesanan
     */
    public function index()
    {
        //model proyek
        $md_proyek = new Proyek();

        //model customers
        $md_customers = new Customer();

        //model list_proyek (order)
        $md_listproyek = new ListProyek();

        //ambil data order
        $orders = $md_listproyek
            ->join('customers','customers.customer_uuid','=','list_proyek.customer_uuid')
            ->join('proyek','proyek.proyek_uuid','=','list_proyek.proyek_uuid')
            ->whereRaw('list_proyek.status <> 5 AND list_proyek.status <> 4')
            ->get();

        //dd($orders);


        return view('Pages.proyek.order_index',['orders'=>$orders]);
    }

    /**
     * order page
     * 
     */
    public function create_page()
    {
    
        //data proyek
        $proyek = Proyek::all();

        return view('Pages.proyek.new_list',['proyeks'=>$proyek]);
    }

    /**
     * new order
     */
    public function store(Request $request)
    {
        //validasi data yang diterima
        $validated = $request->validate([
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'alamat'=>'required|min:4',
            'email'=>'required|email',
            'no_telp'=>'required',
            'proyek_uuid'=>'required',
            'deskripsi'=>'required',
            'tgl_mulai'=>'required',
            'tgl_selesai'=>'required',
            'metode_pembayaran'=>'required'
        ]);

        //ambil data proyek
        $proyek = Proyek::where('proyek_uuid',$request->proyek_uuid)->first();

        //buat uuid untuk nomor order
        $customer_uuid = Str::uuid();

        //simpan data customer
        $customer = Customer::create([
            'customer_uuid'=>$customer_uuid,
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'alamat'=>$request->alamat,
            'email'=>$request->email,
            'no_telp'=>$request->no_telp
        ]);

        //simpan data pesanan
        $order = ListProyek::create([
            'uuid_list'=>Str::uuid(),
            'proyek_uuid'=>$request->proyek_uuid,
            'deskripsi'=>$request->deskripsi,
            'customer_uuid' => $customer_uuid,
            'tgl_mulai'=>$request->tgl_mulai,
            'tgl_selesai'=>$request->tgl_selesai,
            'harga'=>$proyek->harga,
            'metode_pembayaran'=>$request->metode_pembayaran,
            'status'=>0
        ]);

        //
        session()->flash('message','Berhasil Menambahkan');

        //redirect ke halaman  list proyek
        return redirect('/order');
    }

    /**
     * show
     */

     public function show($uuid)
     {
        //model proyek
        $md_proyek = new Proyek();

        //model customers
        $md_customers = new Customer();

        //model list_proyek (order)
        $md_listproyek = new ListProyek();

        //ambil data order
        $orders = $md_listproyek
            ->join('customers','customers.customer_uuid','=','list_proyek.customer_uuid')
            ->join('proyek','proyek.proyek_uuid','=','list_proyek.proyek_uuid')
            ->where('list_proyek.uuid_list','=',$uuid)
            ->first();

        return view('Pages.proyek.detail_order',['details'=>$orders]);
     }

     /**
      * edit page
      @param $uuid
      */

      public function  edit($uuid)
      {

        //model proyek
        $proyek = Proyek::all();

        //model
        $md_listproyek = new ListProyek();

        //ambil data order
        $orders = $md_listproyek
            ->join('customers','customers.customer_uuid','=','list_proyek.customer_uuid')
            ->join('proyek','proyek.proyek_uuid','=','list_proyek.proyek_uuid')
            ->select('list_proyek.*','customers.*','proyek.jenis AS jenis','proyek.model AS model')
            ->where('list_proyek.uuid_list','=',$uuid)
            ->first();

        //dd($orders);

        return view('Pages.proyek.editlist',['details'=>$orders,'proyek'=>$proyek]);
      }

      /**
       * status
       * 0 => belum dibayar dp
       * 1 => sudah dibayar dp
       * 2 => proses
       * 3 => lunas
       * 4 => selesai
       * 5 => dibatalkan
       */
      public function update_status($status, $id)
      {
        switch($status)
        {
            case "dp":
                DB::table('list_proyek')->where( 'uuid_list' ,$id )->update(['status'=>1]);
                break;
            case "proses":
                DB::table('list_proyek')->where( 'uuid_list' ,$id )->update(['status'=>2]);
                break;
            case "lunas":
                DB::table('list_proyek')->where( 'uuid_list' ,$id )->update(['status'=>3]);
                break;
            case "selesai":
                DB::table('list_proyek')->where( 'uuid_list' ,$id )->update(['status'=>4]);
                break;
            case "btl":
                DB::table('list_proyek')->where( 'uuid_list' ,$id )->update(['status'=>5]);
                break;
        }
        return redirect('/order/e/'.$id);
      }

      /**
       * riwayat
       * 
       */
      public function history()
      {
        //model list_proyek (order)
        $md_listproyek = new ListProyek();

        //ambil data order
        $orders = $md_listproyek
            ->join('customers','customers.customer_uuid','=','list_proyek.customer_uuid')
            ->join('proyek','proyek.proyek_uuid','=','list_proyek.proyek_uuid')
            ->get();

        //dd($orders);


        return view('Pages.proyek.history',['orders'=>$orders]);
      }

      /**
       * update
       * @param mixed
       */
      public function update(Request $request, $id)
      {
        $valdator = $request->validate([
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'email'=>'required|email',
            'no_telp'=>'required',
            'jenis'=>'required',
            'tgl_selesai'=>'required|date',
            'harga'=>'required|numeric',
        ]);

        //ambil data proyek
        $data_proyek = ListProyek::where('uuid_list',$id)->first();

        //ambil data customer
        $data_cus = Customer::where('customer_uuid',$data_proyek->customer_uuid)->first();

        //update data customer
        $data_cus->update([
          "firstname"=>$request->firstname,
          "lastname"=>$request->lastname,
          "email"=>$request->email,
          'no_telp'=>$request->no_telp
        ]);

        //update data list proyek
        $data_listproyek = ListProyek::where('uuid_list','=',$id)
            ->update([
                'proyek_uuid'=>$request->jenis,
                'tgl_selesai'=>$request->tgl_selesai,
                'deskripsi'=>$request->deskripsi,
                'harga'=>$request->harga
            ]);

        return redirect('/order/'.$id.'/detail');

      }
}
