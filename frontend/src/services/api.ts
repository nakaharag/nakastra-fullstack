import axios, { AxiosInstance } from 'axios';

import { InputFile, CreateInput } from './types';

const http: AxiosInstance = axios.create({
  baseURL: `http://localhost:8000/api/`,
  headers: {
    'Content-Type': 'application/json'
  }
});

const fetchInputFiles = async (): Promise<InputFile[]> => {
  return await http.get('inputs').then((response) => response.data);
};

const createInputDocument = async (
  data: CreateInput
): Promise<InputFile> => {
  const formData: FormData = new FormData();

  if (data.name) {
    formData.append('name', data.name);
  }

  if (data.description) {
    formData.append('description', data.description);
  }

  if (data.document) {
    formData.append('document', data.document as Blob);
  }

  return await http
    .post('inputs/proccess-document', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    .then((response) => response.data);
};

export { fetchInputFiles, createInputDocument };
