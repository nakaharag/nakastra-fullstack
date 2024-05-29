export type InputFile = {
  debtID: string;
  name: string;
  description: string;
  governementId: string;
  storage_document_path: string;
  email: string;
  created_at: string;
  debtAmount: string;
  debtDueDate: string;
};

export type CreateInput = {
  name: string;
  description: string;
  document: File | undefined;
};
