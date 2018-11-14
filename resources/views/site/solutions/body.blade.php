<div class="body">
    <div class="big_bg">
        <div class="wrap">
            <div class="bgTXT">
                <h5>解决方案</h5>
                <p>从实际需求出发，为您定制专属解决方案</p>
            </div>
        </div>
    </div>


    <div class="wrap">
        <div class="solutionType">
            <ul>
              @foreach($integrations as $integration)
                    <li>
                        <div class="solBox">
                            <div class="typesPic" style="background-image:url('{{ pic($integration->pic)[0]['url'] }}');"></div>
                            <div class="typeName">{{ $integration->name }}</div>
                            <div class="typesWords">
                                <dl>
                                    <i class="arrow round"></i>
                                    <dd>
                                      @foreach($integration->child as $child)
                                            <a href="{{ route('solution.show',$child->id) }}"><i></i> {{ $child->name }}</a>
                                    @endforeach
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </li>
               @endforeach
                <div class="clear"></div>
            </ul>
        </div>
    </div>



</div>
