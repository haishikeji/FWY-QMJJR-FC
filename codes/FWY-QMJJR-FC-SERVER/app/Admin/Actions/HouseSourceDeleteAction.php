<?php

namespace App\Admin\Actions;

use App\Models\HouseMsg;
use App\Models\HouseSource;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;

class HouseSourceDeleteAction extends RowAction
{
	protected int $down=1;
    public function __construct($down=1,$show=0)
    {
        parent::__construct();
		if($show){
			$this->htmlClasses=['btn','btn-sm','btn-success','mr10'];
		}
		if($down){
			$this->title = '<i class="fa fa-level-down"></i> 下架';
		}else{
			$this->title = '<i class="fa fa-level-up"></i> 上架';
		}
	    $this->down=$down;
    }

    /**
     * 处理动作逻辑.
     *
     * @return Response
     */
    public function handle(): Response
    {
        $device_track = HouseSource::query()->where('id', $this->getKey())->first();

        if (empty($device_track)) {
            return $this->response()->error(trans('main.record_none'));
        }
		$device_track->down=1-$device_track->down;
        $device_track->update();
	    if($device_track->down){
		    $str='您的房源已被下架';
	    }else{
		    $str='您的房源已重新上架';
	    }
	    $hmsg=new HouseMsg();
	    $uid=$device_track->uid;
	    $hmsg->fill(['uid'=>$uid,'content'=>$str,'type'=>6]);
	    $hmsg->save();
        return $this->response()
            ->success(trans('main.success'))
            ->refresh();
    }

    /**
     * 对话框.
     *
     * @return string[]
     */
    public function confirm(): array
    {
		if($this->down){
			return ['是否确认下架该房源'];
		}else{
			return ['是否确认上架该房源'];
		}
    }
}
