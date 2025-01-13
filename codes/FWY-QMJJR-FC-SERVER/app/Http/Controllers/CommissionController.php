<?php

namespace App\Http\Controllers;

use App\Models\HouseBroker;
use App\Models\HouseCommission;
use App\Models\HouseWithdraw;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommissionController extends Controller {
	
	public function index(Request $request): JsonResponse {
		$uid=$this->getUid()->id;
		$withdraw=HouseWithdraw::query()->where('uid',$uid)->where('examine_state',1)->selectRaw('id,3 as type,money,created_at,0 as sid');
		$result=HouseCommission::query()->where('uid',$uid)->select(['id','type','money','created_at','sid'])->unionAll($withdraw)
			->latest('created_at')->paginate($request->input('limit'));
		return response()->json(['data'=>$result,'code'=>0]);
	}
}
