import axios from 'axios'

export const useFile = () => {
    const downloadFile = (blob: Blob, filename: string) => {
        const url = URL.createObjectURL(blob);
        const anchor = document.createElement('a');
        anchor.href = url;
        anchor.download = filename;
        document.body.appendChild(anchor);
        anchor.click();
        document.body.removeChild(anchor);
        URL.revokeObjectURL(url);
    }

    const uploadFile = async (file: File, path: string): Promise<string> => {
        const formData = new FormData();
        formData.append('image', file);
        formData.append('path', path)
    
        try {
            const response = await axios.post('/upload', formData);
    
            if (!response) {
                throw new Error('File upload failed');
            }

            return response.data; // Assuming the API returns the file path in the response
        } catch (error) {
            console.error('Error uploading file:', error);
            throw error;
        }
    };

    return {
        downloadFile,
        uploadFile
    }
}