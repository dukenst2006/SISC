<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <strong>Invoice information</strong>
        </div>
    </div>
    <div class="panel-body">

            <div class="form-group form-group-wlabel">
                <div class="col-md-6{{ $errors->has('shipping_method') ? ' has-error' : '' }}">
                    <label for="shipping_method">Shipping Method</label>
                    <input type="text" class="form-control" id="shipping_method" value="{{ old('shipping_method') }}"
                           name="shipping_method">

                    @if ($errors->has('shipping_method'))
                        <span class="help-block">
                            <strong>{{ $errors->first('shipping_method') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-6{{ $errors->has('payment_terms') ? ' has-error' : '' }}">
                    <label for="payment_terms">Payment terms</label>
                    <input type="text" class="form-control" id="payment_terms" value="{{ old('payment_terms') }}"
                           name="payment_terms">

                    @if ($errors->has('payment_terms'))
                        <span class="help-block">
                            <strong>{{ $errors->first('payment_terms') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group form-group-wlabel">
                <div class="col-md-6{{ $errors->has('delivery_date') ? ' has-error' : '' }}">
                    <label for="delivery_date">Delivery date</label>
                    <input type="date" class="form-control" id="delivery_date"
                           value="{{ old('delivery_date') }}" name="delivery_date">

                    @if ($errors->has('delivery_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('delivery_date') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-6{{ $errors->has('due_date') ? ' has-error' : '' }}">
                    <label for="due_date">Due date</label>
                    <input type="date" class="form-control" id="due_date"
                           value="{{ old('due_date') }}" name="due_date">

                    @if ($errors->has('due_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('due_date') }}</strong>
                        </span>
                    @endif
                </div>

            </div>

    </div>
</div>