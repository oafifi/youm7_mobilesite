<?php
class Utility {
	static function getSecName($secId)
	{
		$secName = '';
		
		switch ($secId) {
			case 12 :
				$secName = 'تحقيقات وملفات';
				break;
			case 65 :
				$secName = 'أخبار عاجلة';
				break;
			case 319 :
				$secName = 'سياسة';
				break;
			case 97 :
				$secName = 'تقارير مصرية';
				break;
			case 203 :
				$secName = 'حوادث';
				break;
			case 296 :
				$secName = 'أخبار المحافظات';
				break;
			case 88 :
				$secName = 'أخبار عربية';
				break;
			case 24 :
				$secName = 'اقتصاد';
				break;
			case 297 :
				$secName = 'بورصة و بنوك';
				break;
			case 286 :
				$secName = 'أخبار عالمية';
				break;
			case 298 :
				$secName = 'أخبار الرياضة';
				break;
			case 48 :
				$secName = 'فن و تليفزيون';
				break;
			case 94 :
				$secName = 'ثقافة';
				break;
			case 89 :
				$secName = 'منوعات و مجتمع';
				break;
			case 245 :
				$secName = 'صحة و طب';
				break;
			case 190 :
				$secName = 'مقالات القراء';
				break;
			case 291 :
				$secName = 'ألبومات اليوم السابع';
				break;
			case 87 :
				$secName = 'مقالات';
				break;
			case 96 :
				$secName = 'صحافة محلية';
				break;
			case 99 :
				$secName = 'صحافة عالمية';
				break;
			case 228 :
				$secName = 'صحافة إسرائيلية';
				break;
			case 299 :
				$secName = 'بقلم رئيس التحرير';
				break;
			case 192 :
				$secName = 'كاريكاتير اليوم';
				break;
			case 251 :
				$secName = 'توك شو';
				break;
		}
		
		return $secName;
	}
}

?>