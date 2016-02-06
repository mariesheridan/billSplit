var isClassSet = false;
var className = '';

function getIsClassSet()
{
    return isClassSet;
}

function setClass(nameToUse)
{
    className = nameToUse;
    isClassSet = true;
}

function getClassName()
{
    return className;
}

function isEmpty(inputArray)
{
    if (inputArray.length <= 0)
    {
        //console.log('Array is empty!')
        return true;
    }
    else
    {
        //console.log('Array is NOT empty!')
        return false;
    }
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

function divForValue(nameToUse, number)
{
    return "<div class='app-value' id='"
           + nameToUse + number
           + "Value'><input type='text' name='"
           + nameToUse + number + "' required></div>";
}

function divForRemove(nameToUse, number)
{
    return "<input type='button' class='app-remove' id='" 
           + nameToUse + number + "Remove' value='Remove' />";
}

function divForPrice(nameToUse, number)
{
    return "<div class='app-price' id='"
           + nameToUse + number
           + "Price'>Price: <input type='number' step='0.01' name='price"
           + number + "' required></div>";
}

function getValues(fromDivId, inputType)
{
    var values = [];
    $(fromDivId + " :" + inputType).each(function(){
        values.push($(this).val());
    });
    return values;
}

