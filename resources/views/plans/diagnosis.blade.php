<!-- Modal -->
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">
        我要诊股
      </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form action="{{ route('asks.store') }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          @include('shared._error')
          <div class="form-group">
            <label for="market"><span class="text-muted">市场</span></label>
            <select class="form-control" name="market" required>
              @foreach(config('classification.markets') as $market => $name)
                <option value="{{ $market }}">{{ $name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="name"><span class="text-danger">*</span><span class="text-muted">名称</span></label>
            <input class="form-control" type="text" name="name" placeholder="如：比特币、阿里巴巴、黄金" required/>
          </div>
          <div class="form-group">
            <label for="symbol"><span class="text-danger">*</span><span class="text-muted">代码</span></label>
            <input class="form-control" type="text" name="symbol" placeholder="如：BTCUSDT、700、300033" required />
          </div>

          <div class="form-group">
            <label for="period"><span class="text-muted">周期</span></label>
            <select class="form-control" name="period" required>
              @foreach(config('classification.periods') as $period)
                <option value="{{ $period }}">{{ $period }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="total"><span class="text-muted">可投总资金</span></label>
            <input class="form-control" type="text" name="total" placeholder="数字" required />
          </div>
          <div class="form-group">
            <label for="unit"><span class="text-muted">资金单位</span></label>
            <input class="form-control" type="text" name="unit" placeholder="如btc、usdt、人民币、美金" required />
          </div>
          <div class="form-group">
            <label for="lever"><span class="text-muted">杠杆</span></label>
            <select class="form-control" name="lever" required>
              @foreach(config('classification.levers') as $lever => $name)
                <option value="{{ $lever }}">{{ $name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="remark"><span class="text-muted">备注(选填)</span></label>
            <textarea class="form-control" name="remark" rows="3"></textarea>
          </div>
          <div class="well well-sm pull-right">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            <button type="submit" class="btn btn-primary"><i class="far fa-save mr-2" aria-hidden="true"></i> 保存</button>
          </div>
        </form>
    </div>
  </div>
</div>
