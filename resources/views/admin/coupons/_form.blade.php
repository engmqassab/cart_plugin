@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
              <div class="control-group">
                <label class="control-label">Amount Type</label>
                <div class="controls">
                <?php $value = ['Percentage', 'Fixed']; ?>
                  <select name="amount_type" id="amount_type" style="width:220px;">
                  @foreach ($value as $valueI)
                <option value="{{ $valueI }}" @if ($valueI == old('amount_type', $coupon->amount_type)) selected @endif>
                        {{ $valueI }}
                </option>
                @endforeach
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Coupon Code</label>
                <div class="controls">
                  <input type="text" name="code_coupon" id="code_coupon" maxlength="15" minlength="5"  value="{{ old('code_coupon', $coupon->code_coupon) }}"required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Amount</label>
                <div class="controls">
                  <input type="text" name="amount" id="amount"  value="{{ old('amount', $coupon->amount) }}"required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Expiry Date</label>
                <div class="controls">
                  <input type="date" name="expiry_date" id="expiry_date" value="{{ old('expiry_date', $coupon->expiry_date) }}"required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                <?php $value = ['Active', 'NotActive']; ?>
                  <select name="status" id="status" style="width:220px;">
                  @foreach ($value as $valueI)
                <option value="{{ $valueI }}" @if ($valueI == old('status', $coupon->status)) selected @endif>
                        {{ $valueI }}
                </option>
                @endforeach
                  </select>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Coupon" class="btn btn-success">
              </div>
            