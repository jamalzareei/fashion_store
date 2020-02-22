<div class="row">
    <div class="col-md-4 pb-3">
        <select class="select2 m-b-10 select2-multiple" data-placeholder="انتخاب کنید"  id="categories" name="categories[]" onchange="changeCategory('{{ route('categories.change') }}', this.value,'#category1')">
            <option  value=""> -- انتخاب دسته بندی --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <label for="categories" style="float: right;position: absolute;right: 5px;top: -20px;">دسته بندی</label>
        <span class="help-block text-danger small error-categories"></span>
                
    </div>
    <div class="col-md-4 pb-3">
        <select class="select2 m-b-10 select2-multiple" data-placeholder="انتخاب کنید"  id="category1" name="categories[]" onchange="changeCategory('{{ route('categories.change') }}', this.value,'#category2')">
            {{-- <option value="" > -- انتخاب زیرشاخه1 --</option> --}}
        </select>
        <label for="category1" style="float: right;position: absolute;right: 5px;top: -20px;">زیرشاخه1</label>
        <span class="help-block text-danger small error-category1"></span>
    </div>
    <div class="col-md-4 pb-3">
        <select class="select2 m-b-10 select2-multiple" data-placeholder="انتخاب کنید"  id="category2" name="categories[]">
            {{-- <option value="" > --  انتخاب زیرشاخه2 --</option> --}}
        </select>
        <label for="category2" style="float: right;position: absolute;right: 5px;top: -20px;">زیرشاخه2</label>
        <span class="help-block text-danger small error-categories.2"></span>
    </div>
</div>
<p class="text-warning small">
    کاربر گرامی; در صورتی که دسته بندی در لیست بالا وجود ندارد با مشاور سایت تماس حاصل نمایید.
</p>