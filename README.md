#############
Interview Task
1. Set Up New Laravel Project
   composer create-project laravel/laravel laraintv
2. Create the Model and Migration
   php artisan make:migration create_products_table --create=products
3. Create the Controller
   php artisan make:controller ProductController --resource --model=Product
4. Define Routes
   Route::get('products/import', [ProductController::class,'imports'])->name('products.import'); 

Route::post('products/importstore', [ProductController::class,'importstore'])->name('products.importstore');

Route::get('products/export', [ProductController::class,'export'])->name('products.export');
 
Route::resource('products', ProductController::class); 
7. Implement CRUD Methods in Controller
8. Create Views
9. Handle Form Validation
10. Implement Flash Messages
11. Configure Mass Assignment Protection
12. Add import and exports
13. Test CRUD Operations

==================================================================
How to run this file
Step 1: 
  Clone this url : git clone https://github.com/btechsaravana2788/laravelcrud11
Step 2:
  Create database laraintv
Step 3:
  run this command php artisan migrate
Step 4:
  run this command php artisan serve
Step 5: 
  run this url : http://127.0.0.1:8000/products/
CSV File format:
https://drive.google.com/file/d/1q1h9O29077hcfvAeaDB-Zf1059a42ba4/view?usp=sharing
To import this file to add new data
Video Link for demo purpose
https://www.loom.com/share/4bfff9fdd13a4ec0a7eb54048e13c0f7?sid=73ec590f-d5e8-40c1-8f29-c71647855075
