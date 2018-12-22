Public Class Form1

    Private Sub Button1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button1.Click
        OpenFileDialog1.InitialDirectory = Application.StartupPath
        OpenFileDialog1.ShowDialog(Me)

        TextBox1.Text = OpenFileDialog1.FileName
        TextBox2.Text = TextBox1.Text & ".min.js"

    End Sub

    Private Sub Form1_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load

    End Sub

    Private Sub Button3_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button3.Click
        Dim m As New Microsoft.Ajax.Utilities.Minifier
        Dim s As String = IO.File.ReadAllText(TextBox1.Text)
        Dim t = m.MinifyJavaScript(s)
        IO.File.WriteAllText(TextBox2.Text, t)


    End Sub
End Class
