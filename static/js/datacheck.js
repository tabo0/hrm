
/*

==================================================================

字符串操作

Trim(string):去除字符串两边的空格

==================================================================

*/



/*

==================================================================

LTrim(string):去除左边的空格

==================================================================

*/

function LTrim(str)

{

    var whitespace = new String(" \t\n\r");

    var s = new String(str);



    if (whitespace.indexOf(s.charAt(0)) != -1)

    {

        var j=0, i = s.length;

        while (j < i && whitespace.indexOf(s.charAt(j)) != -1)

        {

            j++;

        }

        s = s.substring(j, i);

    }

    return s;

}



/*

==================================================================

RTrim(string):去除右边的空格

==================================================================

*/

function RTrim(str)

{

    var whitespace = new String(" \t\n\r");

    var s = new String(str);



    if (whitespace.indexOf(s.charAt(s.length-1)) != -1)

    {

        var i = s.length - 1;

        while (i >= 0 && whitespace.indexOf(s.charAt(i)) != -1)

        {

            i--;

        }

        s = s.substring(0, i+1);

    }

    return s;

}



/*

==================================================================

Trim(string):去除前后空格

==================================================================

*/

function Trim(str)

{

    return RTrim(LTrim(str));

}










/*

IsInt(string,string,int or string):(测试字符串,+ or - or empty,empty or 0)

功能：判断是否为整数、正整数、负整数、正整数+0、负整数+0

*/

function IsInt(objStr,sign,zero)

{

    var reg;

    var bolzero;



    if(Trim(objStr)=="")

    {

        return false;

    }

    else

    {

        objStr=objStr.toString();

    }



    if((sign==null)||(Trim(sign)==""))

    {

        sign="+-";

    }



    if((zero==null)||(Trim(zero)==""))

    {

        bolzero=false;

    }

    else

    {

        zero=zero.toString();

        if(zero=="0")

        {

            bolzero=true;

        }

        else

        {

            alert("检查是否包含0参数，只可为(空、0)");

        }

    }



    switch(sign)

    {

        case "+-":

            //整数

            reg=/(^-?|^\+?)\d+$/;

            break;

        case "+":

            if(!bolzero)

            {

                //正整数

                reg=/^\+?[0-9]*[1-9][0-9]*$/;

            }

            else

            {

                //正整数+0

                //reg=/^\+?\d+$/;

                reg=/^\+?[0-9]*[0-9][0-9]*$/;

            }

            break;

        case "-":

            if(!bolzero)

            {

                //负整数

                reg=/^-[0-9]*[1-9][0-9]*$/;

            }

            else

            {

                //负整数+0

                //reg=/^-\d+$/;

                reg=/^-[0-9]*[0-9][0-9]*$/;

            }

            break;

        default:

            alert("检查符号参数，只可为(空、+、-)");

            return false;

            break;

    }



    var r=objStr.match(reg);

    if(r==null)

    {

        return false;

    }

    else

    {

        return true;

    }

}
function IsNum(inputData) {
    //isNaN(inputData)不能判断空串或一个空格
    //如果是一个空串或是一个空格，而isNaN是做为数字0进行处理的，而parseInt与parseFloat是返回一个错误消息，这个isNaN检查不严密而导致的。
    if (parseFloat(inputData).toString() == "NaN") {
        //alert("请输入数字……");注掉，放到调用时，由调用者弹出提示。
        return false;
    } else {
        return true;
    }
}

