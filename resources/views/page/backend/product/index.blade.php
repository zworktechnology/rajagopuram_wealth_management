@extends('layout.backend.auth')

@section('content')

<div class="page-wrapper">
   <div class="content container-fluid">

      <div class="page-header">
         <div class="content-page-header">
            <h6 >Product</h6>
               <div class="list-btn">
                  <div style="display:flex;">
                     <ul class="filter-list">
                        <li>
                        <a class="btn btn-primary"  data-bs-toggle="modal" data-bs-target=".product-modal-xl">
                              <i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Product</a>
                        </li>
                     </ul>
                  </div>

               </div>
         </div>
      </div>

      <div class="row">
         <div class="col-sm-12">
            <div class="card">

                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-center table-hover datatable table-striped">
                           <thead class="thead-light">
                              <tr>
                                 <th style="width:5%;">S.No</th>
                                 <th style="width:15%;">Product</th>
                                 <th style="width:15%;">Active Customers Count</th>
                                 <th style="width:15%;">Description</th>
                                 {{-- <th style="width:15%;">Image</th> --}}
                                 <th style="width:20%;">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           @foreach ($product_data as $keydata => $product_datas)
                              <tr>
                                 <td >{{ ++$keydata }}</td>
                                 <td >{{ $product_datas['name'] }}</td>
                                 <td>{{ $product_datas['total_products_count'] }}</td>
                                 <td >{{ $product_datas['description'] }}</td>
                                 {{-- @if ($product_datas['image'] == "")
                                        <td ></td>
                                        @elseif ($product_datas['image'] != "")
                                        <td ><a href="{{ asset('assets/product_image/' .$product_datas['image']) }}" target="_blank"><img src="{{ asset('assets/product_image/' .$product_datas['image']) }}"  alt="" width="50" height="50"></a></td>
                                        @endif --}}
                                 <td >
                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                        <li>
                                            <a class="badge bg-info-light" href="{{ route('product.view', ['id' => $product_datas['id']]) }}"  style="color: #28084b;">View Customers</a>
                                        </li>
                                       <li>
                                            <a class="badge bg-warning-light" href="#edit{{ $product_datas['unique_key'] }}" data-bs-toggle="modal" data-bs-target=".productedit-modal-xl{{ $product_datas['unique_key'] }}" style="color: #28084b;">Edit</a>
                                       </li>
                                       <li>
                                          <a href="#delete{{ $product_datas['unique_key'] }}" data-bs-toggle="modal"
                                          data-bs-target=".productdelete-modal-xl{{ $product_datas['unique_key'] }}" class="badge bg-danger-light" style="color: #28084b;">Delete</a>
                                       </li>
                                    </ul>

                                 </td>
                              </tr>

                              <div class="modal fade productedit-modal-xl{{ $product_datas['unique_key'] }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="producteditLargeModalLabel{{ $product_datas['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.product.edit')
                              </div>
                              <div class="modal fade productdelete-modal-xl{{ $product_datas['unique_key'] }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="productdeleteLargeModalLabel{{ $product_datas['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.product.delete')
                              </div>
                           @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>

            </div>
         </div>


      </div>



      <div class="modal fade product-modal-xl" tabindex="-1" role="dialog" aria-labelledby="productLargeModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
            @include('page.backend.product.create')
        </div>



   </div>
</div>
@endsection
