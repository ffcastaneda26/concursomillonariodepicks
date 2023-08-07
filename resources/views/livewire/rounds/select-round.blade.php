<div>
   <div class="container">
    @foreach ($rounds as $round)
    <div class="form-group">
        <div class="col-sm-6 col-sm-offset-3">
            <label for="myField" class="control-label">Radio title:</label>

            <label class="radio-inline">
                <input type="radio" name="myField" value="normal" /> RADIO1
            </label>

            <label class="radio-inline">
                <input type="radio" name="myField" value="high" /> RADIO2
            </label>
        </div>
    </div>
    @endforeach
   </div>
</div>
