<form action="{{route('showPrice')}}" method="post"  class="tab-wizard wizard-circle" >
    {!! csrf_field()!!}
    <h6>Calculate the price </h6>
    <div class="row">
        <div class="col-md-3">
            <div class="form-material">
                <label >Width</label>
                <input type="text" class="form-control"  name="width" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-material">
                <label>Length</label>
                <input type="text" class="form-control" id="firstName1" name="length" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-material">
                <label for="firstName1">Depth</label>
                <input type="text" class="form-control" value="60mm" disabled name="depth">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                <button type="submit" class="btn btn-outline-danger">Show price</button>
            </div>
        </div>
    </div>
</form>
                         