<?php
    
namespace App\Http\Controllers;
    
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
    
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(5);
          
        return view('products.index', compact('products'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {   
        //$request->request->add(['variable', 'value']);
		$validatedData = $request->validated();//$validatedData = $request->validated();
		$slug = Str::slug($request->name);
		//dd($slug);
        // Add additional fields
        $dataToInsert = array_merge($validatedData, [
            'slug' => $slug, 
        ]);
		//dd($dataToInsert);
		Product::create($dataToInsert);
           
        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully.');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show',compact('product'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('products.edit',compact('product'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        //$product->update($request->validated());
		$validatedData = $request->validated();//$validatedData = $request->validated();
		$slug = Str::slug($request->name);
		//dd($slug);
        // Add additional fields
        $dataToInsert = array_merge($validatedData, [
            'slug' => $slug, 
        ]);
        $product->update($dataToInsert);  
        return redirect()->route('products.index')
                        ->with('updated','Product updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
           
        return redirect()->route('products.index')
                        ->with('deleted','Product deleted successfully');
    }
	
	/**
     * Show the form for creating a new resource.
     */
    public function imports(): View
    {
        return view('products.import');
    }
	
	/**
     * Store a newly created resource in storage.
     */
    public function importstore(Request $request): RedirectResponse
    {   
        // Validate the uploaded file
        $request->validate([
            'file' => 'required',
        ]);
        //dd($request);
        // Open and read the CSV file
        if (($handle = fopen($request->file('file')->getRealPath(), 'r')) !== false) {
            // Skip the first row if it's a header
            $header = fgetcsv($handle, 1000, ',');

            // Begin database transaction
            DB::beginTransaction();

            try {
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    // Map CSV data to your database columns
					$slug = Str::slug($row[0]);
                    Product::create([
                        'name' => $row[0],
                        'description' => $row[1],
                        'slug' => $slug,
						'sku' => $row[2],
						'price' => $row[3],
                    ]);
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
				return redirect()->route('products.import')
                        ->with('error','An error occurred while importing the data.');
            }

            fclose($handle);
			return redirect()->route('products.index')
                        ->with('success','CSV data imported successfully!');
        }
		return redirect()->route('products.import')
                        ->with('error','Invalid file.');
		
    }
	
	public function export(){
		// Fetch the data to export
		$data = Product::all();

		// Define the CSV header
		$csvHeader = ['Product Name', 'Product Description', 'Product Slug', 'Product SKU', 'Product Price']; // Adjust based on your model

		// Create a file handle
		$fileName = 'export_' . date('Y-m-d_H-i-s') . '.csv';
		$filePath = storage_path($fileName);
		$handle = fopen($filePath, 'w');

		// Write the header
		fputcsv($handle, $csvHeader);

		// Write each row
		foreach ($data as $row) {
			fputcsv($handle, [
				$row->name, // Replace with your model's attributes
				$row->description,
				$row->slug,
				$row->sku,
				$row->price,
			]);
		}

		fclose($handle);

		// Return the file as a download response
		return response()->download($filePath)->deleteFileAfterSend();
	}
}