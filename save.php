<?php
// PRODUCT
$product = Product::find($item['ma_mat_hang']);
            if ($product !== null) {
                $product->shop_id = 2;
                $product->root_id = $item['id'];
            } else {
                $product = new Product();
                $product->string_id = $item['ma_mat_hang'];
                $product->name = $item['ten_mat_hang'];
                $product->price_package = $item['gia_nhap'];
                $product->price = $item['don_gia'];
                $product->status = 'ready';
                $product->product_type_id = 1;
                $product->producer_id = 1;
                $product->supplier_id = 1;
                $product->shop_id = 2;
                $product->root_id = $item['id'];
            }
            $product->save();



            // CUSTOMER
           // CUSTOMER
           if ($item['ten_kh'] === 'root') {
                $customer = Customer::where('name', 'root')->first();
                $customer->shop_id = 2;
                $customer->root_id = $item['id'];
            } else {
                $customer = Customer::where('phone', $item['dien_thoai'])->first();
                if ($customer !== null) {
                    $customer->shop_id = 2;
                    $customer->root_id = $item['id'];
                    $customer->visited_count += $item['count'];
                } else {
                    $customer = new Customer;
                    $customer->name = $item['ten_kh'];
                    $customer->phone = $item['dien_thoai'];
                    $customer->address = $item['dia_chi'];
                    $customer->zalo = $item['zalo'];
                    $customer->facebook = $item['facebook'];
                    if ($item['loai_kh'] === 0) {
                        $customer->type = 'retail';
                    } else {
                        $customer->type = 'wholesale';
                    }
                    $customer->visited_count = $item['count'];

                    $customer->shop_id = 2;
                    $customer->root_id = $item['id'];
                }
            }
            $customer->save();


// BILL INPUT
if ($item['status'] === 'done') {
                $bill = new BillInput;
                $bill->status = 'done';
                $bill->user_id = 2;
                $bill->shop_id = 3;
                $bill->bill_root_id = $item['id'];
                $bill->created_at = $item['created_at'];
                $bill->updated_at = $item['updated_at'];
                $bill->save();
            }




// Bill Input More
$product = Product::where('shop_id', 3)->where('root_id', $item['id_mat_hang'])->first();
            $bill = BillInput::where('shop_id', 3)->where('bill_root_id', $item['id_hoa_don_nhap'])->first();
            dd($bill);
            if ($product && $bill) {
                $bill_more = new BillInputMore;
                $bill_more->count = $item['so_luong'];
                $bill_more->price = $product->price_package;
                $bill_more->product_id = $product->id;
                $bill_more->bill_input_id = $bill->id;
                $bill_more->created_at = $item['created_at'];
                $bill_more->updated_at = $item['updated_at'];
                $bill_more->save();
            }

// Bill output
$customer = Customer::where('shop_id', 2)->where('root_id', $item['id_kh'])->first();
                $bill = new BillOutput;
                $bill->type = 'retail';
                $bill->user_id = 15;
                if ($customer)
                    $bill->customer_id = $customer->id;
                else
                    $bill->customer_id = $customer->id;
                $bill->sale_of_id = $item['id_sale'];
                $bill->warehouse_id = 3;
                $bill->shop_id = 3;
                $bill->bill_root_id = $item['id'];
                $bill->created_at = $item['created_at'];
                $bill->updated_at = $item['updated_at'];
                $bill->save();bill->save();
            }


// propery product 

if ($product) {
                $property = new PropertiesProduct;
                $property->count = $item['so_luong'];
                $property->type = 'item';
                $property->status = 'ready';
                $property->warehouse_id = 3;
                $property->product_id = $product->id;
                $property->created_at = $item['created_at'];
                $property->updated_at = $item['updated_at'];
                $property->save();
            }

// bill_more output
$product = Product::where('shop_id', 3)->where('root_id', $item['id_mat_hang'])->first();
            $bill = BillOutput::where('shop_id', 3)->where('bill_root_id', $item['id_hoa_don_xuat'])->first();
            if ($product && $bill) {
                $bill_more = new BillOutputMore;
                $bill_more->count = $item['so_luong'];
                $bill_more->price = $item['don_gia'] * 1000;
                $bill_more->type = 'item';
                $bill_more->product_id = $product->id;
                $bill_more->bill_output_id = $bill->id;
                $bill_more->created_at = $item['created_at'];
                $bill_more->updated_at = $item['updated_at'];
                $bill_more->save();
            }
