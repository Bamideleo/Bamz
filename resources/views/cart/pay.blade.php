
  <input type="hidden" name="cmd" value="_cart">
  <input type="hidden" name="upload" value="1">
  <input type="hidden" name="business" value="olaz@bamz.com">

  <?php $count= 0;?>
  @foreach($cart as $carts )
  <?php $count++;?>
  <input type="hidden" name="item_name_{{$count}}" value="{{$carts->name}}">
  <input type="hidden" name="item_number_{{$count}}" value="{{$carts->id}}">
  <input type="hidden" name="quantity_{{$count}}" value="{{$carts->quantity}}">
  <input type="hidden" name="amount_{{$count}}" value="{{$carts->price}}">
  <input type="hidden" name="shipping_{{$count}}" value="{{$carts->conditions->parsedRawValue}}">
@endforeach
  <input type="image" name="submit"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online" formaction="https://www.paypal.com/cgi-bin/webscr">
