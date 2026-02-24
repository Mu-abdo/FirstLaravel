
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/fatora.css') }}">
    <title>Fatora</title>
</head>
<body>
    <div class="top-header">
        @extends('layouts.app')
    </div>

    <div class="card">

        <div class="card-header">
            <div class="card-title">
                <span>البيانات الأساسية</span>
                <span class="info-icon">i</span>
            </div>
        </div>

        <div class="grid">

            <div class="form-group">
                <label>التاريخ</label>
                <input type="datetime-local">
            </div>

            <div class="form-group">
                <label>رقم الفاتورة</label>
                <input type="text">
            </div>

            <div class="form-group">
                <label>الرقم الداخلي</label>
                <input type="text">
            </div>

            <div class="form-group">
                <label>الرقم الضريبي</label>
                <input type="text">
            </div>

            <div class="form-group span-2">
                <label>الشركة</label>
                <select>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group span-2">
                <label>الفرع</label>
                <select>
                    @foreach ($branchs as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>

    {{-- card2 --}}
    <div class="card">

        <div class="card-header">
            <div class="card-title">
                <span>بيانات العميل</span>
                <span class="info-icon">i</span>
            </div>
        </div>

        <div class="grid">

            <div class="form-group">
                <label>نوع العميل</label>
                <select>
                    @foreach ($zebons as $zebon)
                        <option value="{{ $zebon->id }}">{{ $zebon->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>العميل</label>
                <select>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group span-2">
                <label>ملاحظات</label>
                <textarea id="" cols="5" rows="3"></textarea>
            </div>
        </div>

        </div>
    </div>


    <div class="card">
    <h2>أصناف الفاتورة</h2>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>م</th>
                    <th>المخزن</th>
                    <th>الصنف</th>
                    <th>الوحدة</th>
                    <th>تكلفة الصنف</th>
                    <th>الوزن</th>
                    <th>الكمية</th>
                    <th>الكمية بأصغر وحدة</th>
                    <th>السعر</th>
                    <th>% الخصم</th>
                    <th>الرصيد</th>
                    <th>الصافي</th>
                    <th>الوصف</th>
                    <th>
                        <button onclick="addRow()" style="background:green;color:white;padding:5px 10px;">+</button>
                    </th>
                </tr>
            </thead>
            <tbody id="invoiceBody">

            </tbody>
        </table>
    </div>
</div>


    <div class="total" id="totals" >
        <div>إجمالي الكميات: <span id="totalQuantity">0</span></div>
        <div>إجمالي قبل الخصم: <span id="TotalBeforeDiscount">0</span></div>
        <div>خصم الأصناف: <span id="totalDiscount">0</span></div>
        <div>إجمالي بعد الخصم: <span id="totalNet">0</span></div>
        <div>خصم نسبة %: <input type="number" id="discountPercent" value="0" oninput="updateTotals()" /></div>
        <div>الخصم الإضافي: <input type="number" id="additionalDiscount" value="0" oninput="updateTotals()" /></div>
        <div>الإضافي نسبة %: <input type="number" id="additionalPercent" value="0" oninput="updateTotals()" /></div>
        <div>الإجمالي النهائي: <span id="finalTotal">0</span></div>
    </div>


    <div class="btn-submit">
        <button>حفظ فاتورة</button>
        <button>اعتماد فاتورة</button>
        <button>اضافه فاتورة ايجار</button>
    </div>
    <script src="{{ asset('js/web.js') }}"></script>
</body>
</html>
