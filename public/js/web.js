let invoiceData = [];
let masterId = 1;

function generateId() {
    return masterId++;
}

function addRow() {
    let newRow = {
        id: generateId(),
        stock: 'مخزن افتراضي',
        type: '',
        unit: '',
        cost: 0,
        weight: 0,
        quantity: 1,
        smallUnitQuantity: 0,
        price: 0,
        discount: 0,
        balance: 0,
        net: 0,
        description: ''
    };

    calculateNet(newRow);
    invoiceData.push(newRow);
    renderTable();
}

function delRow(id) {
    invoiceData = invoiceData.filter(row => row.id !== id); 
    renderTable();
}

function updateField(id, field, value) {
    let row = invoiceData.find(r => r.id == id);
    if (row) {
        row[field] = value;
        if (['quantity', 'price', 'smallUnitQuantity', 'discount'].includes(field)) {
            calculateNet(row);
        }
        renderTable();
    }
}

function calculateNet(row) {
    let rowTotal = row.quantity * row.price;
    let discountAmount = rowTotal * (row.discount / 100);
    row.net = rowTotal - discountAmount;
    if (row.net < 0) row.net = 0;
}

function renderTable() {
    let tableRows = [];
    invoiceData.forEach((row, index) => {
        let trTable = `
            <tr>
                <td>${index + 1}</td>
                <td>
                    <select class="js-example-responsive" onchange="updateField('${row.id}','stock',this.value)">
                        <option value="مخزن افتراضي" ${row.stock === 'مخزن افتراضي' ? 'selected' : ''}>مخزن افتراضي</option>
                        <option value="مخزن فرعي" ${row.stock === 'مخزن فرعي' ? 'selected' : ''}>مخزن فرعي</option>
                        <option value="حجوزات" ${row.stock === 'حجوزات' ? 'selected' : ''}>حجوزات</option>
                    </select>
                </td>
                <td>
                    <select onchange="updateField('${row.id}','type',this.value)">
                        <option value="---" ${row.type === '---' ? 'selected' : ''}>---</option>
                    </select>
                </td>
                <td>
                    <select onchange="updateField('${row.id}','unit',this.value)">
                        <option value="---" ${row.unit === '---' ? 'selected' : ''}>---</option>
                    </select>
                </td>
                <td>
                    <input type="number" disabled value="${row.cost}" onchange="updateField('${row.id}','cost',parseFloat(this.value))" />
                </td>
                <td>
                    <input type="number" disabled value="${row.weight}" onchange="updateField('${row.id}','weight',parseFloat(this.value))" />
                </td>
                <td>
                    <input type="number" value="${row.quantity}" onchange="updateField('${row.id}','quantity',parseFloat(this.value))" />
                </td>
                <td>
                    <input type="number" disabled value="${row.smallUnitQuantity}" onchange="updateField('${row.id}','smallUnitQuantity',parseFloat(this.value))" />
                </td>
                <td>
                    <input type="number" value="${row.price}" onchange="updateField('${row.id}','price',parseFloat(this.value))" />
                </td>
                <td>
                    <input type="number" value="${row.discount}" onchange="updateField('${row.id}','discount',parseFloat(this.value))" />
                </td>
                <td>
                    <input type="number" disabled value="${row.balance}" onchange="updateField('${row.id}','balance',parseFloat(this.value))" />
                </td>
                <td>
                    <input type="number" disabled value="${row.net}" onchange="updateField('${row.id}','net',parseFloat(this.value))" />
                </td>
                <td>
                    <input type="text" value="${row.description}" onchange="updateField('${row.id}','description',this.value)" />
                </td>
                <td>
                    <span class="del" onclick="delRow(${row.id})">X</span>
                </td>
            </tr>
        `;
        tableRows.push(trTable);
    });

    document.getElementById('invoiceBody').innerHTML = tableRows.join('');
    updateTotals();
    initSelect2();
}

function updateTotals() {
    let totalQuantity = 0;
    let totalDiscountAmount = 0;
    let TotalBeforeDiscount = 0;
    let totalNet = 0;

    invoiceData.forEach(row => {
        let rowTotal = row.quantity * row.price;
        let rowDiscountAmount = rowTotal * (row.discount / 100);

        totalQuantity += row.quantity;
        totalDiscountAmount += rowDiscountAmount;
        TotalBeforeDiscount += rowTotal;
        totalNet += row.net;
    });

    let discountPercent = parseFloat(document.getElementById('discountPercent').value) || 0;
    let additionalDiscount = parseFloat(document.getElementById('additionalDiscount').value) || 0;
    let additionalPercent = parseFloat(document.getElementById('additionalPercent').value) || 0;

    let netAfterPercent = totalNet - (totalNet * discountPercent / 100);
    let netAfterAdditional = netAfterPercent - additionalDiscount;
    let netAfterAdditionalPercent = netAfterAdditional - (netAfterAdditional * additionalPercent / 100);

    document.getElementById('totalQuantity').innerText = totalQuantity;
    document.getElementById('TotalBeforeDiscount').innerText = TotalBeforeDiscount;
    document.getElementById('totalDiscount').innerText = totalDiscountAmount;
    document.getElementById('totalNet').innerText = totalNet;
    document.getElementById('finalTotal').innerText = netAfterAdditionalPercent;

    initSelect2();
}

function initSelect2() {
    $('#invoiceBody select').select2({
        width: '100%'
    });
}
