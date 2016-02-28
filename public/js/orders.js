var isNameSet = false;
var name = '';
var counter = 1;
var idToAppend = '';
// persons, itemNames, itemPrices, buyers - taken from html

$(document).ready(function () {

    idToAppend = '#app-orders';
    listItems(idToAppend, 'order', items, persons);

    $(document).on('click', '.app-show', function(){
        var showId = $(this).attr('id');
        var number = showId.match(/\d+/);
        var buyers = $('#buyers' + number);
        if (buyers.hasClass('hide'))
        {
            buyers.removeClass('hide');
            $(this).attr('value', 'Hide Details');
        }
        else
        {
            buyers.addClass('hide');
            $(this).attr('value', 'Split With');   
        }
    });

    // Show or hide the quantity textbox
    $(document).on('click', 'input:checkbox', function(){
        if (!$(this).hasClass('check-all'))
        {
            showOrHideQty($(this));
            requireCheckboxPerGroup($(this));
        }
        else
        {
            var status = $(this).is(':checked');
            $('input:checkbox', $(this).parent('.checkbox-area')).prop('checked', status);
            $(this).siblings('.person-checkbox').find('input:checkbox').each(function(){
                showOrHideQty($(this));
                requireCheckboxPerGroup($(this));
            });
        }
    });

    // At the beginning, add quantity beside checked checkboxes
    $('.app-checkbox').each(function(){
        showQuantity($(this), items);
    });

    $("#app-form").submit(function(event){
        validateForm();
    });
 
});

function showQuantity(object, itemsArray)
{
    var number = object.data('number');
    var personName = object.data('name');
    var checkbox = object.find('input:checkbox');
    var itemName = object.closest('.app-item-block').data('itemname');
    if (checkbox.is(':checked'))
    {
        var qtyId = object.closest('.app-item-block').attr('id');
        var qtyValue = getQuantity(itemsArray, itemName, personName);
        object.append(divForQuantity(qtyId, personName, qtyValue));
    }
}

function showOrHideQty(object)
{
    var nameDiv = object.closest('.app-name');
    var checkboxDiv = object.closest('.app-checkbox');
    var personName = checkboxDiv.data('name');
    var number = checkboxDiv.data('number');
    console.log('id: ' + object.attr('id'));
    var id = object.attr('id');
    if (object.hasClass('check-all'))
    {
        return;
    }
    if (object.is(':checked'))
    {
        if (!(nameDiv.attr('qtyVisible')) || (nameDiv.data('qtyVisible') == 'false'))
        {
            var qtyId = nameDiv.closest('.app-item-block').attr('id');
            var itemName = nameDiv.closest('.app-item-block').data('itemname');
            console.log('item: ' + items);
            console.log('itemName: ' + itemName);
            console.log('namediv id: ' + nameDiv.attr('id'));
            var qtyValue = getQuantity(items, itemName, personName);
            checkboxDiv.append(divForQuantity(qtyId, personName, qtyValue));
            nameDiv.data('qtyVisible', 'true');
        }
    }
    else
    {
        checkboxDiv.find('div.app-qty').remove();
        nameDiv.data('qtyVisible', 'false');
    }
}

// Require at least one checkbox checked per group
function requireCheckboxPerGroup(object)
{
    var requiredCheckboxes;
    if (object.hasClass('check-all'))
    {
        requiredCheckboxes = object.siblings('.person-checkbox').find('input:checkbox');
    }
    else
    {
        requiredCheckboxes = object.closest('.person-checkbox').find('input:checkbox');
    }
    var atLeastOneChecked = false;
    requiredCheckboxes.each(function(){
        if ($(this).is(':checked'))
        {
            atLeastOneChecked = true;
        }
    });
    if (atLeastOneChecked)
    {
        requiredCheckboxes.data('checkNeeded', false);
        object.closest('.checkbox-area').children('.check-all').prop('checked', true);
    }
    else
    {
        requiredCheckboxes.data('checkNeeded', true);
        object.closest('.checkbox-area').children('.check-all').prop('checked', false);
    }
}

function getQuantity(itemsArray, itemName, persoName)
{
    var qtyValue = 1;
    if (itemsArray[itemName].hasOwnProperty('buyers'))
    {
        if (itemsArray[itemName]['buyers'].hasOwnProperty(persoName))
        {
            qtyValue = itemsArray[itemName]['buyers'][persoName];
        }
    }
    return qtyValue;
}

function divForSpacer(nameToUse, number)
{
    return "<div class='app-spacer' id='" + nameToUse + number + "Spacer'></div>";
}

function divForLabel(nameToUse, number)
{
    return "<div class='app-label' id='"
           + nameToUse + number + "Label'>"
           + number + ".</div>";
}

function divForItem(nameToUse, number, key, name)
{
    return "<div class='app-item-name' id='"
           + nameToUse + number + "ItemName' data-itemName='"
           + key + "'>"
           + name + "</div>";
}

function divForPrice(nameToUse, number, input)
{
    return "<div class='app-item-price' id='"
           + nameToUse + number + "ItemPrice'>Price: "
           + input + "</div>";
}

function divForShowDetails(nameToUse, number)
{
    return "<input type='button' class='app-show' id='" 
           + nameToUse + number + "Show' value='Split With' />";
}

function divForPersons(nameToUse, number, itemObject, names)
{
    var appendValue = "<div class='hide checkbox-area' id='buyers" + number +"'>";
    appendValue += divForSpacer(nameToUse, number);
    appendValue += divForAll(number);
    appendValue += "<div class='person-checkbox'>";
    for (iter in names)
    {
        var checked = '';
        if (itemObject.hasOwnProperty('buyers'))
        {
            if (itemObject['buyers'].hasOwnProperty(names[iter].replace(/[^a-zA-Z0-9]/g, '')))
            {
                checked = 'checked';
            }
        }
        else
        {
            checked = "checked";
        }
        //var checked = "checked";
        appendValue += divForSpacer(nameToUse, number);
        appendValue += "<div class='app-checkbox' id='" 
                       + nameToUse + number + iter + "' data-name='"
                       + names[iter].replace(/[^a-zA-Z0-9]/g, '') + "' data-number='"
                       + number + "'>" 
                       + "<div class='app-name' id='" 
                       + nameToUse + number + iter 
                       + "Checkbox'>" 
                       + "<input type='checkbox' id='cb" 
                       + nameToUse + number + iter + "' name='"
                       + nameToUse + number 
                       + "Name[]' value='" + names[iter] + "'" + checked + "/>"
                       + "<label for='cb" + nameToUse + number + iter + "'>" + names[iter] 
                       + "</label></div></div>";
    }
    appendValue += "</div></div>";
    return appendValue;
}

function divForAll(number)
{
    return "<input class='check-all' type='checkbox' name='all" 
           + number + "' id='all" + number + "Id' checked/> <label for='all" 
           + number + "Id'>Check All</label>";
}

function divForQuantity(nameToUse, personName, value)
{
    return "<div class='app-qty' id='"
           + nameToUse
           + "Qty'>Qty: <input type='number' step='0.01' name='"
           + nameToUse + personName + "' value='" + value + "' autofocus required/></div>";
}

function divForHiddenItemName(nameToUse, number, item)
{
    return "<input type='hidden' name='" 
           + nameToUse + number + "Name-item-name' value='" 
           + item + "'>";
}

function appendToDiv(divId, nameToUse, number, itemNameInput, itemObject, personNames)
{
    var appendValue = '';
    if (number > 1)
    {
        appendValue += divForSpacer(nameToUse, number);
    }
    appendValue += "<div class='app-item-block' id='" 
                   + nameToUse + number + "' data-itemName='"+ itemNameInput +"'>";
    appendValue += divForHiddenItemName(nameToUse, number, itemNameInput);
    appendValue += divForLabel(nameToUse, number);
    appendValue += divForItem(nameToUse, number, itemNameInput, itemObject['itemName']);
    appendValue += divForPrice(nameToUse, number, itemObject.itemPrice);
    appendValue += divForShowDetails(nameToUse, number);
    appendValue += divForPersons(nameToUse, number, itemObject, personNames);
    appendValue += "</div>";

    $(divId).append(appendValue);
}

function findPriceForItem(itemName, priceList)
{
    for (iter in priceList)
    {
        if (priceList[iter].priceName === itemName)
        {
            return priceList[iter].priceAmount;
        }
    }
    return "";
}

function listItems(divId, nameToUse, itemsArray, personNames)
{
    $(divId).empty();
    counter = 0;
    for (var iter in itemsArray)
    {
        counter++;
        appendToDiv(divId, nameToUse, counter, iter, itemsArray[iter], personNames);
    }
    $('input:checkbox').each(function(){
        requireCheckboxPerGroup($(this));
    });
}

function validateForm()
{
    var checkResult = checkInputs();
    $("#order-body").find('.help-block').each(function(){
        $(this).remove();
    });
    if(checkResult > 0)
    {
        $("#order-body").prepend(divForError(checkResult));
        event.preventDefault(); 
    }
}

function checkInputs()
{
    var result = 0;
    $(".app-item-block").each(function(){
        var id = $(this).attr('id');
        console.log('id: ' + id)
        var number = id.match(/\d+/);
        var breakFromLoop = false;
        $(this).find("input:checkbox").each(function(){
            //if ($(this).prop('required'))
            if ($(this).data('checkNeeded'))
            {
                result = number;
                breakFromLoop = true;
                return false;
            }
        });
        if (breakFromLoop)
        {
            return false;
        }
    });
    console.log("checkinputs");
    return result;
}

function divForError(num)
{
    return "<span class='help-block'><strong>Please check at least one box in item " 
           + num + "!</strong></span>";
}