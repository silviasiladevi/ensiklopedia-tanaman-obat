@extends('layouts.adminMain')

@section('container')
        
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Tambah Data Produk
            </header>
                
            <div class="panel-body">
              <form role="form" action="/menu" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Produk</label>
                  <input type="text" name="nama_menu" class="form-control" id="exampleInputEmail1" placeholder="Nama Produk" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Jenis</label>
                  <select id="exampleInputEmail1" class="form-control" name="type" placeholder="Jenis">
                      <option selected>Choose</option>
                              <option>makanan</option>
                              <option>minuman</option>
                              <option>dessert</option>       
                  </select>
                  <!-- <input type="text" name="jenis" class="form-control" id="exampleInputEmail1" placeholder="Jenis"> -->
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Deskripsi</label>
                  <input type="text" name="desc" class="form-control" id="exampleInputEmail1" placeholder="Deskripsi" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Harga</label>
                  <input type="number" name="price" class="form-control" id="exampleInputPassword1" placeholder="Harga" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Unggah Foto</label>
                  <input type="file" name="pic">
                  
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </form>

            </div>
        </section>
    </div>
</div>    
  
@endsection

