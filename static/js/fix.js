// 产品
function fixProduct(e)
{
    var obj_x = e.parentNode.parentNode.childNodes;
    var productNumber = obj_x[0].innerHTML;
    var productName = obj_x[1].innerHTML;
    var materialNumber = obj_x[2].innerHTML;
    var mouldNumber = obj_x[3].innerHTML;
    var companyNumber = obj_x[4].innerHTML;
    var processNumber = obj_x[5].innerHTML;
    var size = obj_x[6].innerHTML.split("×");
    var length = size[0].trim();
    var width = size[1].trim();
    var thickness = size[2].trim();
    var blankWeight = obj_x[7].innerHTML;
    var yieldStrength = obj_x[8].innerHTML;
    var elongation = obj_x[9].innerHTML;
    var geometricTolerances = obj_x[10].innerHTML;
    var obj_x = e.parentNode.parentNode.nextSibling.childNodes;
    var productWeight = obj_x[0].innerHTML;
    var tensileStrength = obj_x[1].innerHTML;
    document.getElementById('productNumber').value = productNumber;
    $('#productNumber').attr('readonly','readonly');
    document.getElementById('productName').value = productName;
    document.getElementById('materialNumber').value = materialNumber;
    document.getElementById('mouldNumber').value = mouldNumber;
    document.getElementById('companyNumber').value = companyNumber;
    document.getElementById('processNumber').value = processNumber;
    document.getElementById('blankWeight').value = blankWeight;
    document.getElementById('productWeight').value = productWeight;
    document.getElementById('yieldStrength').value = yieldStrength;
    document.getElementById('tensileStrength').value = tensileStrength;
    document.getElementById('elongation').value = elongation;
    document.getElementById('geometricTolerances').value = geometricTolerances;
    document.getElementById('length').value = length;
    document.getElementById('width').value = width;
    document.getElementById('thickness').value = thickness;
    document.getElementById('myModalLabel').innerHTML = '产品信息修改';
}

// 重置产品列表页面的模态框
function resetProductModal(e)
{
    document.getElementById('productNumber').value = '';
    $('#productNumber').removeAttr('readonly');
    document.getElementById('productName').value = '';
    document.getElementById('materialNumber').value = '';
    document.getElementById('mouldNumber').value = '';
    document.getElementById('companyNumber').value = '';
    document.getElementById('processNumber').value = '';
    document.getElementById('blankWeight').value = '';
    document.getElementById('productWeight').value = '';
    document.getElementById('yieldStrength').value = '';
    document.getElementById('tensileStrength').value = '';
    document.getElementById('elongation').value = '';
    document.getElementById('geometricTolerances').value = '';
    document.getElementById('length').value = '';
    document.getElementById('width').value = '';
    document.getElementById('thickness').value = '';
    document.getElementById('myModalLabel').innerHTML = '添加新产品';
}

// 工艺
function fixProcess(e)
{
    var obj_x = e.parentNode.parentNode.childNodes;
    var processNumber = obj_x[0].innerHTML;
    var heatTemperature = obj_x[1].innerHTML;
    var heatDuration = obj_x[2].innerHTML;
    var formingTemperature = obj_x[3].innerHTML;
    var waterInletTemperature = obj_x[4].innerHTML;
    var waterFlow = obj_x[5].innerHTML;
    var holdingPresssure = obj_x[6].innerHTML;
    var holdingDuration = obj_x[7].innerHTML;
    var formingRate = obj_x[8].innerHTML;
    var hasShieldGas = obj_x[9].innerHTML;
    var obj_x = e.parentNode.parentNode.nextSibling.childNodes;
    var demouldingTemperature = obj_x[0].innerHTML;
    var waterOutletTemperature = obj_x[1].innerHTML;

    document.getElementById('processNumber').value = processNumber;
    $('#processNumber').attr('readonly','readonly');
    document.getElementById('heatTemperature').value = heatTemperature;
    document.getElementById('heatDuration').value = heatDuration;
    document.getElementById('formingTemperature').value = formingTemperature;
    document.getElementById('waterInletTemperature').value = waterInletTemperature;
    document.getElementById('waterFlow').value = waterFlow;
    document.getElementById('holdingPresssure').value = holdingPresssure;
    document.getElementById('holdingDuration').value = holdingDuration;
    document.getElementById('formingRate').value = formingRate;
    document.getElementById('hasShieldGas').value = hasShieldGas == "是" ? "Y" : "N";
    document.getElementById('demouldingTemperature').value = demouldingTemperature;
    document.getElementById('waterOutletTemperature').value = waterOutletTemperature;
    document.getElementById('myModalLabel').innerHTML = '工艺信息修改';
}

// 重置工艺列表页面的模态框
function resetProcessModal(e)
{
    document.getElementById('processNumber').value = '';
    $('#processNumber').removeAttr('readonly');
    document.getElementById('heatTemperature').value = '';
    document.getElementById('heatDuration').value = '';
    document.getElementById('formingTemperature').value = '';
    document.getElementById('waterInletTemperature').value = '';
    document.getElementById('waterFlow').value = '';
    document.getElementById('holdingPresssure').value = '';
    document.getElementById('holdingDuration').value = '';
    document.getElementById('formingRate').value = '';
    document.getElementById('hasShieldGas').value = "Y";
    document.getElementById('demouldingTemperature').value = '';
    document.getElementById('waterOutletTemperature').value = '';
    document.getElementById('myModalLabel').innerHTML = '添加新工艺';
}

// 材料
function fixMaterial(e)
{
    var obj_x = e.parentNode.parentNode.childNodes;
    var materialNumber = obj_x[0].innerHTML;
    var companyNumber = obj_x[1].innerHTML;
    var chemicalComponents = obj_x[2].innerHTML;
    var comingWeight = obj_x[3].innerHTML;
    var size = obj_x[4].innerHTML.split("×");
    var length = size[0].trim();
    var width = size[1].trim();
    var thickness = size[2].trim();
    var shelfLife = obj_x[5].innerHTML;
    document.getElementById('materialNumber').value = materialNumber;
    $('#materialNumber').attr('readonly','readonly');
    document.getElementById('companyNumber').value = companyNumber;
    document.getElementById('chemicalComponents').value = chemicalComponents;
    document.getElementById('comingWeight').value = comingWeight;
    document.getElementById('length').value = length;
    document.getElementById('width').value = width;
    document.getElementById('thickness').value = thickness;
    document.getElementById('shelfLife').value = shelfLife;
    document.getElementById('myModalLabel').innerHTML = '材料信息修改';
}

// 重置材料列表页面的模态框
function resetMaterialModal(e)
{
    document.getElementById('materialNumber').value = '';
    $('#materialNumber').removeAttr('readonly');
    document.getElementById('companyNumber').value = '';
    document.getElementById('chemicalComponents').value = '';
    document.getElementById('comingWeight').value = '';
    document.getElementById('length').value = '';
    document.getElementById('width').value = '';
    document.getElementById('thickness').value = '';
    document.getElementById('shelfLife').value = '';
    document.getElementById('myModalLabel').innerHTML = '添加新材料';
}

// 模具
function fixModule(e)
{
    var obj_x = e.parentNode.parentNode.childNodes;
    var mouldNumber = obj_x[0].innerHTML;
    var companyNumber = obj_x[1].innerHTML;
    var materialNumber = obj_x[2].innerHTML;
    var size = obj_x[3].innerHTML.split("×");
    var length = size[0].trim();
    var width = size[1].trim();
    var height = size[2].trim();
    var totalWeight = obj_x[4].innerHTML;
    var upperMoldWeight = obj_x[5].innerHTML;
    var bottomMoldWeight = obj_x[6].innerHTML;
    document.getElementById('mouldNumber').value = mouldNumber;
    $('#mouldNumber').attr('readonly','readonly');
    document.getElementById('companyNumber').value = companyNumber;
    document.getElementById('materialNumber').value = materialNumber;
    document.getElementById('length').value = length;
    document.getElementById('width').value = width;
    document.getElementById('height').value = height;
    document.getElementById('totalWeight').value = totalWeight;
    document.getElementById('upperMoldWeight').value = upperMoldWeight;
    document.getElementById('bottomMoldWeight').value = bottomMoldWeight;
    document.getElementById('myModalLabel').innerHTML = '模具信息修改';
}

// 重置模具列表页面的模态框
function resetModuleModal(e)
{
    document.getElementById('mouldNumber').value = '';
    $('#mouldNumber').removeAttr('readonly');
    document.getElementById('companyNumber').value = '';
    document.getElementById('materialNumber').value = '';
    document.getElementById('length').value = '';
    document.getElementById('width').value = '';
    document.getElementById('height').value = '';
    document.getElementById('totalWeight').value = '';
    document.getElementById('upperMoldWeight').value = '';
    document.getElementById('bottomMoldWeight').value = '';
    document.getElementById('myModalLabel').innerHTML = '添加新模具';
}

// 厂商
function fixCompany(e)
{
    var obj_x = e.parentNode.parentNode.childNodes;
    var companyNumber = obj_x[0].innerHTML;
    var companyName = obj_x[1].innerHTML;
    var address = obj_x[2].innerHTML;
    var contacts = obj_x[3].innerHTML;
    var telephone = obj_x[4].innerHTML;
    var email = obj_x[5].innerHTML;
    document.getElementById('companyNumber').value = companyNumber;
    $('#companyNumber').attr('readonly','readonly');
    document.getElementById('companyName').value = companyName;
    document.getElementById('address').value = address;
    document.getElementById('contacts').value = contacts;
    document.getElementById('phone').value = telephone;
    document.getElementById('email').value = email;
    document.getElementById('myModalLabel').innerHTML = '厂商信息修改';
}

// 重置厂商列表页面的模态框
function resetCompanyModal(e)
{
    document.getElementById('companyNumber').value = '';
    $('#companyNumber').removeAttr('readonly');
    document.getElementById('companyName').value = '';
    document.getElementById('address').value = '';
    document.getElementById('contacts').value = '';
    document.getElementById('phone').value = '';
    document.getElementById('email').value = '';
    document.getElementById('myModalLabel').innerHTML = '添加新厂商';
}

// 设备
function fixEquipment(e)
{
    var obj_x = e.parentNode.parentNode.childNodes;
    var equipmentNumber = obj_x[0].innerHTML;
    var equipmentName = obj_x[1].innerHTML;
    var description = obj_x[2].innerHTML;
    var remark = obj_x[3].innerHTML;
    document.getElementById('equipmentNumber').value = equipmentNumber;
    document.getElementById('equipmentName').value = equipmentName;
    document.getElementById('description').value = description;
    document.getElementById('remark').value = remark;
}

// 用户
function fixPerson(e)
{
    var obj_x = e.parentNode.parentNode.childNodes;
    var account = obj_x[0].innerHTML;
    var name = obj_x[1].innerHTML;
    var userGroup = obj_x[2].innerHTML;
    var department = obj_x[3].innerHTML;
    var telephone = obj_x[4].innerHTML;
    var usable = obj_x[5].innerHTML;
    var remark = obj_x[7].innerHTML;
    document.getElementById('account').value = account;
    $('#account').attr('readonly','readonly');
    document.getElementById('name').value = name;
    document.getElementById('usergroup').value = userGroup;
    document.getElementById('department').value = department;
    document.getElementById('telephone').value = telephone;
    document.getElementById('usable').value = usable == '可用' ? 'Y' : 'N';
    document.getElementById('remark').value = remark;
    document.getElementById('myModalLabel').innerHTML = '修改用户信息';
}

// 重置用户列表页面的模态框
function resetPersonModal(e)
{
    document.getElementById('account').value = '';
    $('#account').removeAttr('readonly');
    document.getElementById('name').value = '';
    document.getElementById('usergroup').value = '';
    document.getElementById('password').value = '';
    document.getElementById('department').value = '';
    document.getElementById('telephone').value = '';
    document.getElementById('usable').value = 'Y';
    document.getElementById('remark').value = '';
    document.getElementById('myModalLabel').innerHTML = '添加新用户';
}