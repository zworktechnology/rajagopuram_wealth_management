@extends('layout.backend.auth')

@section('content')

<div class="page-wrapper">
   <div class="content container-fluid">

      <div class="page-header">
         <div class="content-page-header">
            <h6 style="text-transform:uppercase">Product</h6>
               <div class="list-btn">
                  <div style="display:flex;">
                     <ul class="filter-list">
                        <li>
                        <a class="btn btn-primary" style="text-transform:uppercase" data-bs-toggle="modal" data-bs-target=".product-modal-xl">
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
                                 <th style="width:5%;text-transform:uppercase">S.No</th>
                                 <th style="width:15%;text-transform:uppercase">Product</th>
                                 <th style="width:15%;text-transform:uppercase">Total Count</th>
                                 <th style="width:15%;text-transform:uppercase">Description</th>
                                 <th style="width:15%;text-transform:uppercase">Image</th>
                                 <th style="width:20%;text-transform:uppercase">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           @foreach ($product_data as $keydata => $product_datas)
                              <tr>
                                 <td style="text-transform:uppercase">{{ ++$keydata }}</td>
                                 <td style="text-transform:uppercase">{{ $product_datas['name'] }}</td>
                                 <td><a href="{{ route('product.view', ['id' => $product_datas['id']]) }}">{{ $product_datas['total_products_count'] }}</a></td>
                                 <td style="text-transform:uppercase">{{ $product_datas['description'] }}</td>
                                 @if ($product_datas['image'] == "")
                                        <td style="text-transform:uppercase"></td>
                                        @elseif ($product_datas['image'] != "")
                                        <td style="text-transform:uppercase"><a href="{{ asset('assets/product_image/' .$product_datas['image']) }}" target="_blank"><img src="{{ asset('assets/product_image/' .$product_datas['image']) }}"  alt="" width="50" height="50"></a></td>
                                        @endif
                                 <td style="text-transform:uppercase">
                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                       <li>
                                       <a class="badge bg-warning-light" href="#edit{{ $product_datas['unique_key'] }}" data-bs-toggle="modal"
                                          data-bs-target=".productedit-modal-xl{{ $product_datas['unique_key'] }}" style="color: #28084b;">Edit</a>
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