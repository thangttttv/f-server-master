$(function () {
    $('select[name="user_id"]').on('change', function () {
        generateBankAccounts();
    });


    function generateBankAccounts() {
        var bankAccountSelector = $('#bank_account_id');
        Boilerplate.bankAccounts.forEach(function (bankAccount) {
            if( bankAccount.id == $('#user_id').val() ) {
                bankAccountSelector.append('<option value="' + bankAccount.id + '">' + bankAccount.name + '</option>');
            }
        });
        $('.selectpicker').selectpicker('refresh');

    }

});
