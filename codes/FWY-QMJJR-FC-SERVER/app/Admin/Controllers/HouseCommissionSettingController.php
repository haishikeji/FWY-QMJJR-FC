<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\BrokerSettingForm;
use App\Admin\Forms\CommissionSettingForm;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Routing\Controller;

class HouseCommissionSettingController extends Controller
{
	public function index(Content $content): Content
	{
		return $content
			->title($this->title())
			->description(admin_trans_label('description'))
			->body(function (Row $row) {
				$card=new Card();
				$card->content(new CommissionSettingForm());
				$row->column(12,$card);
			});
	}
	
	public function title(): array|string|Translator|null
	{
		return admin_trans_label('title');
	}
}
