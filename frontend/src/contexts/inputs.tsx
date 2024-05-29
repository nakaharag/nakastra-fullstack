/* eslint-disable @typescript-eslint/no-empty-function */
import { fetchInputFiles } from "@/services/api";
import { InputFile } from "@/services/types";
import { ReactNode, createContext, useState } from "react";

interface IFileInputContext {
  inputs: InputFile[];
  addCreatedInputToList: (input: InputFile) => void,
  getInputs: () => void,
}

export const ListInputContext = createContext<IFileInputContext>({
  inputs: [],
  addCreatedInputToList: () => {},
  getInputs: () => {},
});

export const ListInputProvider = ({ children }: { children: ReactNode }) => {
  const [inputs, setInputs] = useState<InputFile[]>([]);

  const addCreatedInputToList: IFileInputContext["addCreatedInputToList"] = (
    inputs: InputFile,
  ) => {
    return setInputs((prev) => [inputs, ...prev ]);
  };

  const getInputs: IFileInputContext["getInputs"] = async () => {

    const data = await fetchInputFiles().then(data => data)
    return setInputs(data);
  }

  return (
    <ListInputContext.Provider
      value={{
        inputs,
        addCreatedInputToList,
        getInputs,
      }}
    >
      {children}
    </ListInputContext.Provider>
  );
};