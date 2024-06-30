export const useValidator = () => {
    const requiredValidator = ( value ) => {
        if(value == '' || value == undefined || value == null){
            return 'this field is required'
        }

        return true
    }

    const confirmPasswordValidator = ( confirm, password ) => {
        if(confirm !== password){
            return "Passwords doesn't match"
        }

        return true
    }

    return {
        requiredValidator,
        confirmPasswordValidator
    }
}