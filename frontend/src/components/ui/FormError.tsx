type FormErrorProps = {
  message?: string | null;
};

const FormError = ({ message }: FormErrorProps) => {
  if (!message) {
    return null;
  }

  return (
    <div className="w-full rounded-md border border-[#7a1f25] bg-[#f3dfe1] px-4 py-2 text-sm text-[#5a1015]" role="alert">
      {message}
    </div>
  );
};

export default FormError;
