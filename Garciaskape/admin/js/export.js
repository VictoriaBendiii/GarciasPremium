function exportToExcelAll(tableID, filename = ''){
                        var downloadurl;
                        var dataFileType = 'application/vnd.ms-excel';
                        var tableSelect = document.getElementById(tableID);
                        var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');

                        filename = filename?filename+'.xls':'AllReport.xls';

                        downloadurl = document.createElement("a");

                        document.body.appendChild(downloadurl);

                        if(navigator.msSaveOrOpenBlob){
                            var blob = new Blob(['\ufeff', tableHTMLData], {
                                type: dataFileType
                            });
                            navigator.msSaveOrOpenBlob(blob, filename);
                        }else{

                            downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
                            downloadurl.download = filename;
                            downloadurl.click();
                        }
                    }

function exportToExcelOrder(tableID, filename = ''){
                        var downloadurl;
                        var dataFileType = 'application/vnd.ms-excel';
                        var tableSelect = document.getElementById(tableID);
                        var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');

                        filename = filename?filename+'.xls':'OrderReport.xls';

                        downloadurl = document.createElement("a");

                        document.body.appendChild(downloadurl);

                        if(navigator.msSaveOrOpenBlob){
                            var blob = new Blob(['\ufeff', tableHTMLData], {
                                type: dataFileType
                            });
                            navigator.msSaveOrOpenBlob(blob, filename);
                        }else{

                            downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
                            downloadurl.download = filename;
                            downloadurl.click();
                        }
                    }

function exportToExcelDelivery(tableID, filename = ''){
                        var downloadurl;
                        var dataFileType = 'application/vnd.ms-excel';
                        var tableSelect = document.getElementById(tableID);
                        var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');

                        filename = filename?filename+'.xls':'DeliveryReport.xls';

                        downloadurl = document.createElement("a");

                        document.body.appendChild(downloadurl);

                        if(navigator.msSaveOrOpenBlob){
                            var blob = new Blob(['\ufeff', tableHTMLData], {
                                type: dataFileType
                            });
                            navigator.msSaveOrOpenBlob(blob, filename);
                        }else{

                            downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
                            downloadurl.download = filename;
                            downloadurl.click();
                        }
                    }

function exportToExcelSoldItem(tableID, filename = ''){
                        var downloadurl;
                        var dataFileType = 'application/vnd.ms-excel';
                        var tableSelect = document.getElementById(tableID);
                        var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');

                        filename = filename?filename+'.xls':'SoldItemReport.xls';

                        downloadurl = document.createElement("a");

                        document.body.appendChild(downloadurl);

                        if(navigator.msSaveOrOpenBlob){
                            var blob = new Blob(['\ufeff', tableHTMLData], {
                                type: dataFileType
                            });
                            navigator.msSaveOrOpenBlob(blob, filename);
                        }else{

                            downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
                            downloadurl.download = filename;
                            downloadurl.click();
                        }
                    }
function exportToExcelRequest(tableID, filename = ''){
                        var downloadurl;
                        var dataFileType = 'application/vnd.ms-excel';
                        var tableSelect = document.getElementById(tableID);
                        var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');

                        filename = filename?filename+'.xls':'OrderRequestReport.xls';

                        downloadurl = document.createElement("a");

                        document.body.appendChild(downloadurl);

                        if(navigator.msSaveOrOpenBlob){
                            var blob = new Blob(['\ufeff', tableHTMLData], {
                                type: dataFileType
                            });
                            navigator.msSaveOrOpenBlob(blob, filename);
                        }else{

                            downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
                            downloadurl.download = filename;
                            downloadurl.click();
                        }
                    }
