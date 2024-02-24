<?php

namespace App\Http\Controllers\Auth;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\CheckReviewsRequest;
use App\Models\User;
use App\Http\Controllers\Controller;


class ReviewsController extends Controller
{
    public function index(){
        $allReviews = page_paginate(5,Review::class);
        return view('auth.reviews.index',compact('allReviews'));
    }

    public function create(){
        return view('auth.reviews.create');
    }

    public function store(CheckReviewsRequest $request){
        $result = $request->validated();
        $checkUser = User::select('email','name','id')->where('email',session('email'))->where('name',session('name'))->first();
        create_review($checkUser,$result);
        return redirect()->route('auth.reviews')->with('success','create_review');
    }

    public function show($post){
        $show = Review::select('id','title','content','user_id','created_at','like')->where('id',(int)$post)->first();
        if($show) {
            $arr = [];
            $arr = show_reviews($show,User::class,$arr);
            return view('auth.reviews.show', compact('arr'));
        }
    }

    public function like($post, Request $request){
        return like_review($request,$post);
    }

}
