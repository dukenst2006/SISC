<div class="panel panel-default">
    <div class="panel-heading">Customer details</div>
    <div class="panel-body">

        <form class="form-horizontal" role="form" method="POST"
              action="{{ url('/customer/update') }}" autocomplete="on">

            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <input name="id" type="hidden" value="{{ $customer['id'] }}">
            <input name="customer_hash" type="hidden" value="{{ $customer_hash }}">

            <div class="form-group form-group-wlabel{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name"
                           value="{{ $customer['name'] }}" name="name">
                    <i class="fa fa-user"></i>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group form-group-wlabel">
                <div class="col-md-8{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address">Address</label>

                    <input type="text" class="form-control" id="address"
                           value="{{ $customer['address'] }}" name="address">
                    <i class="fa fa-user"></i>

                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-4{{ $errors->has('city') ? ' has-error' : '' }}">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city"
                           value="{{ $customer['city'] }}" name="city">
                    <i class="fa fa-user"></i>

                    @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group form-group-wlabel">
                <div class="col-md-6{{ $errors->has('postcode') ? ' has-error' : '' }}">
                    <label for="postcode">Postcode</label>
                    <input type="text" class="form-control" id="postcode"
                           value="{{ $customer['postcode'] }}" name="postcode">
                    <i class="fa fa-envelope"></i>

                    @if ($errors->has('postcode'))
                        <span class="help-block">
                            <strong>{{ $errors->first('postcode') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-6{{ $errors->has('country') ? ' has-error' : '' }}">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country"
                           value="{{ $customer['country'] }}" name="country">
                    <i class="fa fa-envelope"></i>

                    @if ($errors->has('country'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group form-group-wlabel{{ $errors->has('vat') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <label for="vat">VAT</label>
                    <input type="text" class="form-control" id="vat"
                           value="{{ $customer['vat'] }}" name="vat">
                    <i class="fa fa-envelope"></i>

                    @if ($errors->has('vat'))
                        <span class="help-block">
                            <strong>{{ $errors->first('vat') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group form-group-wlabel{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <label for="email">E-mail address</label>
                    <input type="email" class="form-control" id="email"
                           value="{{ $customer['email'] }}" name="email">
                    <i class="fa fa-envelope"></i>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group form-group-wlabel">
                <div class="col-md-6{{ $errors->has('telephone') ? ' has-error' : '' }}">
                    <label for="telephone">Telephone</label>
                    <input type="text" class="form-control" id="telephone"
                           value="{{ $customer['telephone'] }}" name="telephone">
                    <i class="fa fa-envelope"></i>

                    @if ($errors->has('telephone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telephone') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-6{{ $errors->has('mobile') ? ' has-error' : '' }}">
                    <label for="mobile">Mobile</label>
                    <input type="text" class="form-control" id="mobile"
                           value="{{ $customer['mobile'] }}" name="mobile">
                    <i class="fa fa-envelope"></i>

                    @if ($errors->has('mobile'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group form-group-wlabel">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update info</button>
                </div>
            </div>

        </form>

    </div>
</div>