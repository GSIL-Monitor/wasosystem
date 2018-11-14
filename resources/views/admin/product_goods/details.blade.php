@inject('ProductParamenterPresenter','App\Presenters\ProductParamenterPresenter')
@php $pinyin=$ProductParamenterPresenter->showPinyin();$childs=$product->Childrens()->whereParentId(0)->oldest('order')->get();@endphp
@foreach( $childs as $childCanShu)
    @php $ZDCanShus=$ProductParamenterPresenter->showCanShu($childCanShu);
        $detailsPinYin=strtolower($pinyin->permalink($childCanShu->name,'_'));
    @endphp
    <li>
        <div class="liLeft">{{ $childCanShu->name }}：{{ $loop->iteration }}</div>
        <div class="liRight">
            @if($childCanShu->type === 'input')
                {{  Form::text('details['.$detailsPinYin.']',old('details['.$detailsPinYin.']'),['placeholder'=>'请输入'.$childCanShu->name]) }}
            @endif
            @if($childCanShu->type === 'select')
                @if(count($ZDCanShus) > 0)
                    {{ Form::select('details['.$detailsPinYin.']',$ZDCanShus,old('details['.$detailsPinYin.']'),['class'=>'select2','placeholder'=>'请选择'.$childCanShu->name]) }}
                @endif
            @endif
            @if($childCanShu->type === 'checkbox')
                @if(count($ZDCanShus) > 0)
                    @foreach($ZDCanShus as $key=>$ZDCanShu)
                            <label for="details{{ $childCanShu->id }}{{ $key }}">
                                {{ Form::checkbox('details['.$detailsPinYin.'][]',$key,old('details['.$detailsPinYin.']'),['id'=>"details".$childCanShu->id.$key]) }}{{ $ZDCanShu }}
                            </label>
                    @endforeach
                @endif
            @endif
            @if($childCanShu->type === 'radio')
                        <label for="details{{ $detailsPinYin }}">
                            {{ Form::checkbox('details['.$detailsPinYin.']',$key,old('details['.$detailsPinYin.']'),['id'=>"details".$detailsPinYin]) }}
                        </label>
        @endif
        </div>
        <div class="clear"></div>
    </li>
@endforeach