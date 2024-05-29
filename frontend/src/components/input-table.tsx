/* eslint-disable react-hooks/exhaustive-deps */
import { ReactElement, useContext, useEffect } from "react"

import * as Ui from './ui';
import format from "date-fns/format";
import { ListInputContext } from "@/contexts/inputs";

const InputTable = (): ReactElement => {

  const { inputs, getInputs } = useContext(ListInputContext);

  useEffect(() => {
    getInputs();
  }, []);

  return (
    <div>
      <Ui.Table className="mt-6">
        <Ui.TableCaption>Últimos processamentos</Ui.TableCaption>
        <Ui.TableHeader>
          <Ui.TableRow className="text-white">
            <Ui.TableHead>Identificador</Ui.TableHead>
            <Ui.TableHead className="w-[50%]">Nome</Ui.TableHead>
            <Ui.TableHead>Número do documento</Ui.TableHead>
            <Ui.TableHead>Email do sacado</Ui.TableHead>
            <Ui.TableHead>Valor</Ui.TableHead>
            <Ui.TableHead className="text-right">Data de Criação</Ui.TableHead>
          </Ui.TableRow>
        </Ui.TableHeader>
        <Ui.TableBody>
          {inputs.map((input) => (
            <Ui.TableRow key={input.debtID}>
              <Ui.TableCell className="font-medium">{input.name}</Ui.TableCell>
              <Ui.TableCell>{input.governementId}</Ui.TableCell>
              <Ui.TableCell>{input.email}</Ui.TableCell>
              <Ui.TableCell>{input.debtAmount}</Ui.TableCell>
              <Ui.TableCell className="text-right">{format(new Date(input.created_at), 'dd/MM/yyyy HH:mm:ss')}</Ui.TableCell>
              {/* <Ui.TableCell className="text-right">{input.debtDueDate}</Ui.TableCell> */}
            </Ui.TableRow>
          ))}
        </Ui.TableBody>
      </Ui.Table>
    </div>
  );
};

export { InputTable }