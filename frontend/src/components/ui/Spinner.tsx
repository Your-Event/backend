type SpinnerProps = {
  size?: "sm" | "md";
};

const Spinner = ({ size = "md" }: SpinnerProps) => {
  const dimension = size === "sm" ? "h-4 w-4" : "h-6 w-6";

  return (
    <span
      className={`${dimension} inline-block animate-spin rounded-full border-2 border-black/30 border-t-black`}
      aria-label="Loading"
      role="status"
    />
  );
};

export default Spinner;
