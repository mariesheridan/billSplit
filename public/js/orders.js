var isNameSet = false;
var name = '';
var counter = 1;
var idToAppend = '';
// persons, itemNames, itemPrices, buyers - taken from html

$(document).ready(function () {

    idToAppend = '#app-orders';
    listItems(idToAppend, 'order', itemNames, items, itemPrices, persons);

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
    $(document).on('click', '.app-name', function(){
        var checkboxDiv = $(this).closest('.app-checkbox');
        var personName = checkboxDiv.data('name');
        var number = checkboxDiv.data('number');
        if ($(this).find('input:checkbox').is(':checked'))
        {
            if ($(this).data('qtyVisible') == false)
            {
                console.log('checked');
                var qtyId = $(this).closest('.app-item-block').attr('id');
                var itemName = $(this).closest('.app-item-block').data('itemname');
                var qtyValue = getQuantity(items, itemName, personName);
                checkboxDiv.append(divForQuantity(qtyId, personName, qtyValue));
                $(this).data('qtyVisible', true);
            }
        }
        else
        {
            checkboxDiv.find('div.app-qty').remove();
            $(this).data('qtyVisible', false);
        }
    });

    // Require at least one checkbox checked per group
    $(document).on('click', '.app-checkbox', function(){
    /*
        var requiredCheckboxes = $(this).closest('div.person-checkbox').find('input:checkbox');
        var atLeastOneChecked = false;
        requiredCheckboxes.each(function(){
            console.log("val: " + $(this).val());
            if ($(this).is(':checked'))
            {
                atLeastOneChecked = true;
            }
        });
        if (atLeastOneChecked)
        {
            requiredCheckboxes.removeAttr('required');
        }
        else
        {
            requiredCheckboxes.attr('required', 'required');
        }
    */
        requireCheckboxPerGroup($(this));
    });

    // At the beginning, add quantity beside checked checkboxes
    $('.app-checkbox').each(function(){
        var number = $(this).data('number');
        var personName =$(this).data('name');
        console.log('name = ' + personName);
        var checkbox = $(this).find('input:checkbox');
        var itemName = $(this).closest('.app-item-block').data('itemname');
        console.log('itemName = ' + itemName);
        if (checkbox.is(':checked'))
        {
            var qtyId = $(this).closest('.app-item-block').attr('id');
            var qtyValue = getQuantity(items, itemName, personName);
            $(this).append(divForQuantity(qtyId, personName, qtyValue));
        }
    });
 
});


function requireCheckboxPerGroup(object)
{
    var requiredCheckboxes = object.closest('div.person-checkbox').find('input:checkbox');
    var atLeastOneChecked = false;
    requiredCheckboxes.each(function(){
        console.log("val: " + $(this).val());
        if ($(this).is(':checked'))
        {
            atLeastOneChecked = true;
        }
    });
    if (atLeastOneChecked)
    {
        requiredCheckboxes.removeAttr('required');
    }
    else
    {
        requiredCheckboxes.attr('required', 'required');
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

function divForItem(nameToUse, number, input)
{
    return "<div class='app-item-name' id='"
           + nameToUse + number + "ItemName' data-itemName='"
           + input + "'>"
           + input + "</div>";
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
    var appendValue = "<div class='hide person-checkbox' id='buyers" + number +"'>";
    for (iter in names)
    {
        var checked = '';
        console.log("names [iter] = " + names[iter]);
        if (itemObject.hasOwnProperty('buyers'))
        {
            if (itemObject['buyers'].hasOwnProperty(names[iter]))
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
                       + nameToUse + number + names[iter] + "' data-name='"
                       + names[iter] + "' data-number='"
                       + number + "'><div class='app-name' id='" 
                       + nameToUse + number + names[iter] 
                       + "Checkbox'><input type='checkbox' name='"
                       + nameToUse + number 
                       + "Name[]' value='" + names[iter] + "' required " + checked + "/>"
                       + names[iter] + "</div></div>";
    }
    appendValue += "</div>";
    return appendValue;
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

function appendToDiv(divId, nameToUse, number, itemNameInput, itemObject, price, personNames)
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
    appendValue += divForItem(nameToUse, number, itemNameInput);
    appendValue += divForPrice(nameToUse, number, price);
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

function listItems(divId, nameToUse, itemNamesInput, itemsArray, prices, personNames)
{
    console.log("itemNamesInput = " + itemNamesInput);
    console.log("items = " + items);
    $(divId).empty();
    counter = 0;
    for (var iter in itemNamesInput)
    {
        counter++;
        var itemObject = itemsArray[itemNamesInput[iter]];
        console.log("itemObject[" + itemNamesInput[iter] + "] = " + itemObject);
        appendToDiv(divId, nameToUse, counter, itemNamesInput[iter], itemObject, prices[iter], personNames);
    }
    $('.app-checkbox').each(function(){
        requireCheckboxPerGroup($(this));
    });
}

