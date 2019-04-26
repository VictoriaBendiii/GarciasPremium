 function cloneRow(){
                var row = document.getElementById("dropdowns");
                var table = document.getElementById("tableDrop");
                var clone = row.cloneNode(true);
                clone.id = "dropdowns";
                table.appendChild(clone);
            }

            function RemoveOrder(){
                var rowCount = document.getElementById('tableDrop').rows.length;
                var td = event.target.parentNode;
                var tr = td.parentNode;
                if (rowCount > 2) {
                    tr.parentNode.removeChild(tr);
                } else {
                    alert("Should have atleast one order!");
                }
            }