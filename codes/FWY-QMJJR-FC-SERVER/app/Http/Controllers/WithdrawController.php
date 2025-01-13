<?php

namespace App\Http\Controllers;

use App\Models\HouseBroker;
use App\Models\HouseWithdraw;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class WithdrawController extends Controller {
	
	public function index(Request $request) {
		$uid=$this->getUid()->id;
		$result=HouseWithdraw::query()->where('uid',$uid)->latest()->paginate($request->input('limit'),['id','money','examine_state','pay_state','created_at']);
		return response()->json(['data'=>$result,'code'=>0]);
	}
	public function last(Request $request) {
		$uid=$this->getUid()->id;
		$result=HouseWithdraw::query()->with(['bank'])->where('uid',$uid)->latest()->first();
		return response()->json(['data'=>$result,'code'=>0]);
	}
	public function save(Request $request) {
		$broker=$this->getUid();
		if($broker->state!=1){
			return response()->json(['msg' => '用户被冻结', 'code' => 1]);
		}
		$money=$request->input('money');
		if($money>$broker->money){
			return response()->json(['msg'=>'余额不足','code'=>1]);
		}
		$min=admin_setting('min');
		if($min>$money){
			return response()->json(['msg'=>'提现金额最少'.$min.'元','code'=>1]);
		}
		$withdraw=new HouseWithdraw();
		$withdraw->uid=$broker->id;
		$rate=admin_setting('fee');
		$withdraw->real_money=$money*(100-$rate)/100;
		$withdraw->fill($request->all());
		$withdraw->save();
		$broker->money-=$money;
		$broker->update();
		return response()->json(['data'=>'','code'=>0]);
	}
}
