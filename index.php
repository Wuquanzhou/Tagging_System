<html>
    <head>
    <script type="text/javascript">
        function AddTableRow()
        {
            '<span style="white-space:pre">    </span>'var Table = document.getElementById("tab");   //取得自定义的表对象
            '<span style="white-space:pre">    </span>'NewRow = Table.insertRow();                        //添加行
            '<span style="white-space:pre">    </span>'NewCell1= NewRow.insertCell();                     //添加列
            NewCell2=NewRow.insertCell();
            NewCell1.innerHTML = "<B>这是新加的列</B>";          //添加数据
            NewCell1.innerHTML="<a href='#'>这是空链接</a>";
        }
    </script>
    </head>
    <body>
        <table id="tab">
            <tr><td>1</td></tr>
            <tr><td>2</td></tr>
        </table>
    <input type="button" id="bn" value="add" onclick="AddTableRow()" />
    </body>
</html>