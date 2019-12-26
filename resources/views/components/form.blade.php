@if(Auth::check())
        {{ csrf_field() }}
        <h4> Message </h4>

        <input type="hidden" name="comment_id" value='0' class="comment_id">
        <textarea name="message" id="textarea" class="form-control" cols="30" rows="3" placeholder="Введите комментарий"></textarea><br>

        <button id="submit" class="btn btn-success submit"> Submit</button>
@endif
