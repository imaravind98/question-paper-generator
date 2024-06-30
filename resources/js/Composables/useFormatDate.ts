export const useFormatDate = () => {
    const formatDate = (dateString: string) => {
        const date = new Date(dateString);
        if (isNaN(date.getTime())) {
            throw new Error("Invalid date");
        }
    
        const day = date.getDate().toString().padStart(2, '0');
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const month = monthNames[date.getMonth()]; // Get the month name
        const year = date.getFullYear().toString();
    
        return `${day}-${month}-${year}`;
    }

    return{
        formatDate
    }
}