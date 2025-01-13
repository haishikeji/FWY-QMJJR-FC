<?php

namespace App\Admin\Actions\Show;

use App\Admin\Forms\BrokerExamineForm;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Show\AbstractTool;
use Dcat\Admin\Traits\HasPermissions;
use Dcat\Admin\Widgets\Modal;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SourceExamine extends AbstractTool
{
    /**
     * @return string
     */
	protected $title = '';
	protected $style = '';
	protected mixed $state = 1;
	protected mixed $icon = 'fa-check';
	
	public function __construct($state = 1) {
		parent::__construct();
		$this->state=$state;
		if($state==1){
			$this->title='<a href="javascript:;" class="btn btn-sm btn-success"><i class="fa fa-check"></i>通过审核</a>';
		}else{
			$this->style='btn btn-sm btn-danger';
			$this->title='<a href="javascript:;" class="btn btn-sm btn-danger mr10"><i class="fa fa-times"></i>驳回审核</a>';
		}
	}
	
	public function html(): string {
		return '<a href="javascript:;" class="'.$this->style.'"><i class="fa '.$this->icon.'"></i> ' . $this->title.'</a>';
	}
	
	public function render(): Modal
	{
		$form = BrokerExamineForm::make()->payload([
			'state' => $this->state,
			'type' => 'source',
			'id' => $this->getKey(),
		]);
		$title=admin_trans('main.examine');
		if($this->state==1){
			$title='审核通过后'.admin_setting('broker').'即可获得'.admin_setting('register').admin_setting('commission');
		}
		return Modal::make()
			->lg()
			->title($title)
			->body($form)
			->button($this->title);
	}
}
