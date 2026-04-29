import * as React from "react";

type InputProps = React.InputHTMLAttributes<HTMLInputElement> & {
  label: string;
  error?: string;
};

const Input = React.forwardRef<HTMLInputElement, InputProps>(
  ({ label, error, className, id, ...props }, ref) => {
    const inputId = id ?? props.name ?? label.replace(/\s+/g, "-");

    return (
      <div className="flex w-full flex-col gap-2 text-left">
        <label className="text-xs font-semibold uppercase tracking-wide text-[#3b3b3b]" htmlFor={inputId}>
          {label}
        </label>
        <input
          ref={ref}
          id={inputId}
          className={`h-11 w-full rounded-md border border-transparent bg-[#6b0f17] px-4 text-sm text-white placeholder:text-[#f0dada] focus:outline-none focus:ring-2 focus:ring-[#3a050a] ${className ?? ""}`}
          {...props}
        />
        {error ? (
          <p className="text-xs text-[#7a1f25]" role="alert">
            {error}
          </p>
        ) : null}
      </div>
    );
  }
);

Input.displayName = "Input";

export default Input;
