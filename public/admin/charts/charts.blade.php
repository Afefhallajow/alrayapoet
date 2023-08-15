<div class="container_chart">
    @if($chart_seats == 'square')
    <table class="table table-bordered">
        @for($i=1;$i<=$place->rows_count;$i++)
            <tr>
                @for($j=1;$j<=$place->columns_count;$j++)
                    @if(isset($data[$i][$j]))
                        @php $chair = $data[$i][$j]; @endphp
                        <td
                            class="chair-td {{ $dataInvited[$i][$j] ? 'reserved' : '' }}" 
                            style="background: {{$chair['cat_color']}}; color: {{$chair['cat_color_text']}}"
                            data-id = "{{$chair['id']}}"
                            data-code = "{{$chair['code']}}"
                            data-name = "{{$chair['cat_name']}}"
                            data-image = "{{$chair['cat_image']}}"
                            data-invited = "{{$dataInvited[$i][$j]}}"
                            data-i = "{{$i}}"
                            data-j = "{{$j}}"
                            >

                            <span>رقم الكرسي: {{$i}} - {{$j}}</span>
                            <br>
                            
                            <span>
                                {{ $chair['code'] }}
                                <br>
                            </span>
                            
                            <span>
                                فئة الكرسي: {{$chair['cat_name']}}
                                <br>
                                <br>
                            </span>
                            
                            <span class="invited_info">
                                {{ $dataInvited[$i][$j] }}
                                <br>
                            </span>
                        </td>
                    @else
                        <td class="chair-td" 
                            style="background:#eee; color: #000"
                            data-i = "{{$i}}"
                            data-j = "{{$j}}"
                        >
                            <span>{{$i}} - {{$j}}</span>
                        </td>
                    @endif
                @endfor
            </tr>
        @endfor
    </table>
    @elseif($place->chart_seats == 'circle')
    @for ($i = 1; $i <=$place->tables_count; $i++)
        <div class="container_table container_table_{{$i}}">
            <div class="table_ch table_ch_{{$i}}">
                @if(count($tables_chairs) > 0)
                    @for ($j = 1; $j <= $tables_chairs[$i]; $j++)
                        @if(isset($data[$i][$j]))
                            @php $chair = $data[$i][$j]; @endphp
                            <div 
                                class="chair {{ $dataInvited[$i][$j] ? 'reserved' : '' }}" 
                                style="background: {{$chair['cat_color']}}; color: {{$chair['cat_color_text']}}"
                                data-id = "{{$chair['id']}}"
                                data-code = "{{$chair['code']}}"
                                data-name = "{{$chair['cat_name']}}"
                                data-image = "{{$chair['cat_image']}}"
                                data-invited = "{{$dataInvited[$i][$j]}}"
                                data-i = "{{$i}}"
                                data-j = "{{$j}}"
                            >
                                <span>{{$i}}-{{$j}}</span>
                                <span>{{$chair['code']}}</span>
                            </div>
                        @else
                            <div 
                                class="chair" 
                                style="background:#eee; color: #000"
                                data-i = "{{$i}}"
                                data-j = "{{$j}}"
                            >
                                <span>{{$i}}-{{$j}}</span>
                            </div>
                        @endif
                    @endfor
                @endif
            </div>
        </div>
    @endfor
    @endif
</div>