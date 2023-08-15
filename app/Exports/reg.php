<?php

namespace App\Exports;

use App\Models\Registered;
use App\Models\season;
use App\Models\temp;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class reg implements withEvents, FromQuery, Responsable, WithHeadings, WithStyles, WithMapping
{
    use Exportable;
    private $fileName = 'شاعر الراية.xlsx';

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array{
        if(\Illuminate\Support\Facades\Auth::user()->type==1 || Auth::user()->type == 5)
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;

        $evas=User::where('season',$season)->where('type',2)->get();
$array=array();
$array[0]='المعرف';
        $array[1]='الاسم';
$i=2;
        foreach ($evas as $e)
{
    $array[$i]=$e->name;
$i++;
}
        $array[count($evas)+2]='المتوسط';

        return $array;
    }



    /**
    * @return \Illuminate\Support\Collection
    */

    public function query()
    {   if(\Illuminate\Support\Facades\Auth::user()->type==1 || Auth::user()->type == 5)
    {$temp=temp::all();
        $season=$temp[0]->season_id;

    }else
        $season=\Illuminate\Support\Facades\Auth::user()->season;

        $row = Registered::query()->select()->where('ev1_percent','>',0)->where('season','=',$season);
return $row;
    }


    public function map($row): array
    {   if(\Illuminate\Support\Facades\Auth::user()->type==1 || Auth::user()->type == 5)
    {$temp=temp::all();
        $season=$temp[0]->season_id;

    }else
        $season=\Illuminate\Support\Facades\Auth::user()->season;
$arr= array();
$arr[0]=$row->id;
$arr[1]=$row->name;
        $evas=User::where('season',$season)->where('type',2)->get();
        $j=2;
        if($evas != null )
            for ($i=0;$i<count($evas);$i++)
            {$bool =0;
                foreach ($row->evas as $ev )
                {if($ev->user_id==$evas[$i]->id)
                {$bool=1;
                    $arr[$j]=$ev->percent;
                }}
                if($bool ==0)
                {
                    $arr[$j]='-';
                }
            $j++;
            }
$arr[count($evas)+2]=$row->ev1_percent;


            return $arr;

    }

    public function registerEvents(): array
    {
return [AfterSheet::class =>function(AfterSheet $event){
 $event->sheet->getDelegate()->setRightToLeft(true);
}];    }
}
