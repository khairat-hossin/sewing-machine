<?php

namespace App\Http\Controllers\Admin\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setup\Item;
use DB,Validator;
class ItemController extends Controller
{
    //
    public function index(){
    	$items= Item::get();
    	return view('admin.setup.item.index', compact('items'));
    }

    //create item
    public function create(){
    	return view('admin.setup.item.create');
    }

    //store item
    public function storeItem(Request $request){
        
    	$validator= Controller::validateItemData($request->all());
    	
    	if($validator->fails()){
    		return back()->withInput()->with('error', 'invalid input!');
    	}
    	else{
    		$item= new Item();
    		$item->item_code= $request->item_code;
    		$item->item_name= $request->item_name;

    		try {
                $item->save();
                return redirect('admin/setup/item')->with('success', 'Item added Successfully');
    			
    		} catch (\Exception $e) {
    			return back()->withInput()->with('error','Something went wrong!');
    		}
    	}
    }

    //edit item
    public function editItem($id){
        $item= Item::where('id', $id)->first();
        return view('admin.setup.item.edit', compact('item'));
    }

    //update item
    public function updateItem(Request $request){
        $validator= Controller::validateItemData($request->all());

        if($validator->fails()){
            return back()->withInput()->with('error', 'invalid input!');
        }
        else{            
            try {
                Item::where('id', $request->id)
                ->update([
                    'item_code' => $request->item_code,
                    'item_name' => $request->item_name
                ]);
                return redirect('admin/setup/item')->with('success', 'Item updated Successfully');
                
            } catch (\Exception $e) {
                return back()->withInput()->with('error','Something went wrong!');
            }
        }
    }

    //view item
    public function viewItem($id){
        $item= Item::where('id', $id)->first();
        return view('admin.setup.item.view', compact('item'));
    }

    //delete item
    public function deleteItem($id){
        $item= Item::where('id', $id)->delete();
        return redirect('admin/setup/item')->with('success', 'Item deleted successfully!');
    }
}
