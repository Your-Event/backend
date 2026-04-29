import AuthShell from "@/components/auth/AuthShell";
import RegisterForm from "@/components/forms/RegisterForm";

export default function RegisterPage() {
  return (
    <AuthShell
      title="Create account"
      subtitle="Tell us a bit about you to get started."
    >
      <RegisterForm />
    </AuthShell>
  );
}
