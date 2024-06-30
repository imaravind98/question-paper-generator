export const useValidator = () => {
    const requiredValidator = ( value ) => {
        if(value == '' || value == undefined || value == null){
            return 'this field is required'
        }

        return true
    }

    return {
        requiredValidator
    }
}