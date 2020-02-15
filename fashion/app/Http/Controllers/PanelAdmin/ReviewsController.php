<?php

namespace App\Http\Controllers\PanelAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\DecorReview;

class ReviewsController extends Controller
{
    //
    public function reviews(Request $request, $type = 'product')
    {
        # code...
        $reviews = null;
        if($type == 'product'){
            $reviews = ProductReview::latest('review_id')
            ->select('*','review_id as id')
            ->with(['product' => function($query){ $query->select('slug','productid'); }])
            ->paginate(50);
        }else{
            $reviews = DecorReview::latest('id')->with(['decor' => function($query){ $query->select('slug','id'); }])->paginate(50);
        }

        // return $reviews[0][$type]->slug;

        return view('admin.pages-admin.list-reviews', [
            'reviews'   => $reviews,
            'type'      => $type,
            'title'     => 'لیست نظرات کاربران',
        ]);
    }

    
    public function reviewDelete(Request $request, $type = 'product', $id)
    {
        # code...
        $review = null;
        if($type == 'product'){
            $review = ProductReview::where('review_id', $id)->first();
            $reviewDelete = ProductReview::where('review_id', $id)->delete();
        }else{
            $review = DecorReview::where('id', $id)->first();
            $reviewDelete = DecorReview::where('id', $id)->delete();
        }

        if(!$review){
            if (request()->ajax) {
                return [
                    'title' => '',
                    'message' => 'کامنت وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ];
            } else {
                return redirect()->route('panel.adminer.reviews')->with('noty', [
                    'title' => '',
                    'message' => 'کامنت وجود ندارد',
                    'status' => 'error',
                    'data' => '',
                ]);
            }
        }
        
        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ];
        } else {
            return redirect()->route('panel.adminer.reviews')->with('noty', [
                'title' => '',
                'message' => 'با موفقیت حذف گردید.',
                'status' => 'info',
                'data' => '',
            ]);
        }
    }

    
    public function reviewUpdate(Request $request, $type = 'product', $id, $column)
    {
        // return $request->all();
        $date = null;
        if($column == 'reply'){
            $date = [
                'reply' => $request->reply
            ];
        }elseif ($column == 'active') {
            # code...
            $date = [
                'active' => ($request->active) ? 'Y' : null
            ];
        }
        # code...
        if($type == 'product'){
            $review = ProductReview::where('review_id', $id)->update($date);
        }else{
            $review = DecorReview::where('id', $id)->update($date);
            
        }
        if (request()->ajax) {
            return [
                'title' => '',
                'message' => 'با موفقیت ثبت گردید.',
                'status' => 'success',
                'data' => '',
            ];
        } else {
            return redirect()->back()->with('noty', [
                'title' => '',
                'message' => 'با موفقیت ثبت گردید.',
                'status' => 'success',
                'data' => '',
            ]);
        }
    }
}
