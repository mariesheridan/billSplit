var isNameSet = false;
var name = '';
var counter = 1;
var idToAppend = '';
// persons, itemNames, itemPrices, buyers - taken from html

$(document).ready(function () {

    idToAppend = '#app-orders';
    listItems(idToAppend, 'order', itemNames, itemPrices, persons);

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
        var id = $(this).attr('id');
        var number = id.match(/\d+/);
        var myRegexp = /^order\d+(.*)/;
        var match = myRegexp.exec(id);
        var name = match[1];

        var checkboxDiv = $(this).closest('.app-checkbox');
        if ($(this).find('input:checkbox').is(':checked'))
        {
            if ($(this).data('qtyVisible') == false)
            {
                console.log('checked');
                var qtyId = $(this).closest('.app-item-block').attr('id');
                checkboxDiv.append(divForQuantity(qtyId, name, 1));
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
    });

    // At the beginning, add quantity beside checked checkboxes
    $('.app-checkbox').each(function(){
        var id = $(this).attr('id');
        var number = id.match(/\d+/);
        var myRegexp = /^order\d+(.*)/;
        var match = myRegexp.exec(id);
        var name = match[1];
        console.log('name = ' + name);
        var checkbox = $(this).find('input:checkbox');
        if (checkbox.is(':checked'))
        {
            var qtyId = $(this).closest('.app-item-block').attr('id');
            $(this).append(divForQuantity(qtyId, name, 1));
        }
    });
 
});

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

function divForPersons(nameToUse, number, names)
{
    var appendValue = "<div class='hide person-checkbox' id='buyers" + number +"'>";
    for (iter in names)
    {
        appendValue += divForSpacer(nameToUse, number);
        appendValue += "<div class='app-checkbox' id='" 
                       + nameToUse + number + names[iter]
                       + "'><div class='app-name' id='" 
                       + nameToUse + number + names[iter] 
                       + "Checkbox'><input type='checkbox' name='"
                       + nameToUse + number 
                       + "Name[]' value='" + names[iter] + "' required checked/>"
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
           + nameToUse + personName + "' value='" + value + "'required /></div>";
}

function appendToDiv(divId, nameToUse, number, name, price, personNames)
{
    var appendValue = '';
    if (number > 1)
    {
        appendValue += divForSpacer(nameToUse, number);
    }
    appendValue += "<div class='app-item-block' id='" + nameToUse + number + "'>";
    appendValue += divForLabel(nameToUse, number);
    appendValue += divForItem(nameToUse, number, name);
    appendValue += divForPrice(nameToUse, number, price);
    appendValue += divForShowDetails(nameToUse, number);
    appendValue += divForPersons(nameToUse, number, personNames);
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

function listItems(divId, nameToUse, names, prices, personNames)
{
    console.log(names);
    $(divId).empty();
    counter = 0;
    for (var iter in names)
    {
        counter++;
        appendToDiv(divId, nameToUse, counter, names[iter], prices[iter], personNames);
    }
}

