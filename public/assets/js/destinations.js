$(document).ready(function() {

    $(document).on('click', '.edit-destination', function() {
        $('#edit_destination_name').val('');
        $('#edit_destination_name').val($(this).data('destination_name'));
        $('#destination_id').val($(this).data('destination_id'));
        $('#modal_edit_destination').modal('show');
    });
    $(document).on('click', '.closemodify', function() {
        //localStorage.removeItem('stockitems');
        location.reload();
    });

    $(document).on('click', '.modify-destination', function() {

        $('#id').val($(this).data('id'));
        $('#destination_modify_id').val($(this).data('destination_id'));
        $('#destination_modify_status').val($(this).data('destination_status'));
        $('#modifydestinationModal').modal('show');
    });
    $('.modal-footer').on('click', '#modifydestination', function() {
  
        $.ajax({
            type: 'post',
            url: '/panel/destinations/modify',
            data: {
                //_token:$(this).data('token'),
                '_token': $('input[name=_token]').val(),
                'destination_id': $('input[name=destination_modify_id]').val(),
                'destination_status': $('input[name=destination_modify_status]').val()
                
            },
            success: function(data) {
                $('#modifydestinationModal').modal('toggle');
                let status;
                if(data.status === 'active'){
                    status = 'inactive';
                }
                else {
                    status = 'active';
                }
                $('#destination_status_'+data.id).text(data.status);
                $('#modifydestination' + data.id).data('category_status', status);
                //$('#modifydestinationModalSuccess').modal('show');
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toastr-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.success("Destination status updated");
            },
            
            error: function(data){
              var errors = data.responseJSON.errors;
              var errormessage = '';
              Object.keys(errors).forEach(function(key) {
                  errormessage += errors[key] + '<br />';
                  $('.errors').html('');
                  $('.errors').append(`
                  <div class="alert alert-danger" role="alert"> ${errormessage} </div>
                  `);
              });
            }
        });
    });

    $("#updatedestination").click(function(data) {
          $.ajax({
              type: 'post',
              url: '/panel/destinations/edit',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'destination_name': $('input[name=edit_destination_name]').val(),
                  'destination_code': $('input[name=edit_destination_code]').val(),
                  'counter_id': $('select[name=edit_counter]').val(),
                  'destination_id': $('input[name=destination_id]').val()
              },
              success: function(data) {
                $('#destination_name_'+data.id).text(data.destination_name);
                $('#destination_edit_' + data.id).data('destination_name', data.destination_name);
                $('#destination_code_'+data.id).text(data.destination_code);
                $('#destination_edit_' + data.id).data('destination_code', data.destination_code);

                $('#destination_counter_'+data.id).text(data.counter_name);
                $('#destination_edit_' + data.id).data('counter_id', data.counter_id);
                $('#modal_edit_destination').modal('toggle');
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toastr-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.success("Destination updated");
              },
              error: function(data){
                const errorContainer = document.getElementById('errors');
                let errors = data.responseJSON.errors;
                let errormessage = '';
                Object.keys(errors).forEach(function(key) {
                    errormessage += errors[key] + '<br />'; 
                });
                errorContainer.innerHTML = ` <div class="alert alert-danger" role="alert"> ${errormessage} </div>`;
                errorContainer.hidden = false;
              }
  
          });
    });
    $("#adddestination").click(function(data) {
        $.ajax({
            type: 'post',
            url: '/panel/destinations/add',
            data: {
                '_token': $('input[name=_token]').val(),
                'destination_name': $('input[name=destination_name]').val(),
                'counter_id': $('select[name=counter]').val(),
                'destination_code': $('input[name=destination_code]').val()
            },
            success: function(data) {
            $('#destinationTable').append(`
            <tr class="row${data.id}">
                <td>${data.id}</td>
                <td>${data.destination_name}</td>
                <td>${data.counter_name}</td>
                <td >
                    <span class="label label-inline label-light-success font-weight-bold">
                    ${data.status}
                    </span>
                </td>
                <td class="action">
                    <a href="/panel/destinations/${data.id}" class="btn btn-sm btn-active-light--success">
                        <span class="svg-icon svg-icon-muted svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="currentColor"/>
                        <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="currentColor"/>
                        </svg>
                        </span>
                    </a>
                    <a href="javascript:;" id="destination_edit_${data.id}" class="btn btn-icon btn-active-light-info edit-destination"
                            data-destination_name="${data.destination_name}"
                            data-destination_id="${data.id}"
                        >
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                            </svg>
                        </span>
                    </a>
                    <a href="javascript:;" id="modifydestination" class="btn btn-sm btn-active-light--info modify-destination"
                        data-destination_id="${data.id}"
                        data-destination_status="inactive"
                    >
                    <span class="svg-icon svg-icon-muted svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"/>
                    <rect x="9" y="13.0283" width="7.3536" height="1.2256" rx="0.6128" transform="rotate(-45 9 13.0283)" fill="currentColor"/>
                    <rect x="9.86664" y="7.93359" width="7.3536" height="1.2256" rx="0.6128" transform="rotate(45 9.86664 7.93359)" fill="currentColor"/>
                    </svg></span>
                    </a>
                </td>
            </tr>  
            `);
            $('#destination_name').val('');
            $('#modal_destination').modal('toggle');
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toastr-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.success("Destination Added");
            },
            error: function(data){
            const errorContainer = document.getElementById('errors');
            let errors = data.responseJSON.errors;
            let errormessage = '';
            Object.keys(errors).forEach(function(key) {
                errormessage += errors[key] + '<br />'; 
            });
            errorContainer.innerHTML = ` <div class="alert alert-danger" role="alert"> ${errormessage} </div>`;
            errorContainer.hidden = false;
            }

        });
    });
   
});
  