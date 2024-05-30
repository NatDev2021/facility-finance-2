<div class="row g-3">
    @foreach ($user_permissions as $row)
        <div class="col-md-4">
            <p>{{ $row->description}}</p>

            @foreach($row->subMenus as $subMenu)
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="{{$subMenu->id}}" name="permissions[]" value="{{$subMenu->id}}" {{$subMenu->checked}}>
                        <label class="custom-control-label" for="{{$subMenu->id}}">{{$subMenu->description}}</label>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>




